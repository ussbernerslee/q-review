import {Component, OnInit, QueryList, ViewChild, ViewChildren} from "@angular/core";
import {CardComponent} from "../card/card.component";
import {LeaderboardComponent} from "../leaderboard/leaderboard.component";
import {BoardComponent} from "../board/board.component";
import {LedgerService} from "../shared/services/ledger.service";
import {Profile} from "../shared/classes/profile";
import {ActivatedRoute} from "@angular/router";
import {Ledger} from "../shared/classes/ledger";
import {Card} from "../shared/classes/card";
import {FormGroup, FormBuilder, Validators} from "@angular/forms";
import {Status} from "../shared/classes/status";
import {CardService} from "../shared/services/card.service";
import {Category} from "../shared/classes/category";
import {PubNubAngular} from "pubnub-angular2";

declare const $: any;
@Component({
	template: require("./captain.html")
})

export class CaptainComponent implements OnInit {

	boardId: string;
	players: Profile[] = [];
	ledgerForm: FormGroup;
	status: Status = null;
	card: Card;
	numGames : number = 4;
	placeholderArray : any[] = new Array(this.numGames);
	cards: Card[][] = [];
	categories: Category[] = [];
	gameState: any = {};
	engaged: boolean = false;

	@ViewChild(CardComponent) cardComponent: CardComponent;
	@ViewChild(LeaderboardComponent) leaderboardComponent: LeaderboardComponent;
	@ViewChildren(BoardComponent) gameComponents: QueryList<BoardComponent>;

	constructor(protected ledgerService:LedgerService, protected pubnub: PubNubAngular, protected route:ActivatedRoute, protected formBuilder: FormBuilder, protected cardService:CardService) {
		this.gameState = {
			boardName: "",
			finalQuestion: "",
			cards: [],
			leaderboard: [],
			queue: []
		};
		for(let i = 0; i < this.numGames; i++) {
			this.cards[i] = [];
			this.categories[i] = null;
			this.gameState.cards.push({categoryName: "", availableCards: []});
		}
		this.pubnub.init({
			publishKey: "pub-c-f4761826-34d5-4b1c-8977-ce66a5199a53",
			subscribeKey: "sub-c-4c7ad82a-141f-11e8-acae-aa071d12b3f5",
			ssl: true
		});
	}

	ngOnInit() : void {
		this.boardId = this.route.snapshot.params.boardId;
		this.loadLeaderboard();

		this.ledgerForm = this.formBuilder.group({
			select:["",[Validators.required]]
		});
		this.getCardId();
		this.pubnub.subscribe({channels: "kmaru-" + this.boardId});
	}

	disableCard() :  void {
		$("#ledger-modal").modal('hide');
		this.gameComponents.forEach(game => {
			let cardIndex = game.cards.findIndex(card => card.cardId === this.card.cardId);
			if(cardIndex >= 0) {
				this.gameState.cards[game.index].availableCards[cardIndex] = null;
				game.availableCards[cardIndex] = false;
			}
		});
	}

	plus() : void {
		let ledger: Ledger = new Ledger(this.boardId, this.card.cardId, this.ledgerForm.value.select, this.card.cardPoints, "1");
		this.ledgerService
			.postLedger(ledger)
			.subscribe(status => {
				this.status = status;
				if (status.status === 200){
					this.disableCard();
					this.loadLeaderboard();
				}
			});
}

	subtract() : void {
		let ledger: Ledger = new Ledger(this.boardId, this.card.cardId, this.ledgerForm.value.select, -this.card.cardPoints, "1");

			this.ledgerService.postLedger(ledger)
			.subscribe(status => this.status = status);
		this.loadLeaderboard();

	}

	getCardId() : void {
		this.cardService.cardObserver.subscribe(cards => this.card = cards);
	}

	engage() : void {
		this.engaged = true;
		this.publishGameState();
	}

 	loadLeaderboard() : void {
		this.ledgerService
			.getLedgerByLedgerBoardId(this.boardId)
			.subscribe(profiles => {
				this.players = profiles;
				let newLeaderboard: any[] = [];
				for(let player of this.players) {
					newLeaderboard.push({username: player.profileUsername, points: player.info});
				}
				this.gameState.leaderboard = newLeaderboard;
				this.publishGameState();
			});

	}

	loadCards(cardData: any) : void {
		let index = cardData.index;
		this.cards[index] = cardData.cards;
		this.gameState.cards[index].availableCards = [];
		for(let card of this.cards[index]) {
			this.gameState.cards[index].availableCards.push(card.cardPoints);
		}
	}

	loadCategories(categoryData: any) : void {
		let index = categoryData.index;
		this.categories[index] = categoryData.category;
		this.gameState.cards[index].categoryName = this.categories[index].categoryName;
	}

	publishGameState() : void {
		this.pubnub.publish({message: this.gameState, channel: "kmaru-" + this.boardId});
	}

}

