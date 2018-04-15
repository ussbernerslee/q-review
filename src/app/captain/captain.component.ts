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

	constructor(protected ledgerService:LedgerService, protected route:ActivatedRoute, protected formBuilder: FormBuilder, protected cardService:CardService) {
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
	}

	ngOnInit() : void {
		this.boardId = this.route.snapshot.params.boardId;
		this.loadLeaderboard();

		this.ledgerForm = this.formBuilder.group({
			select:["",[Validators.required]]
		});
		this.getCardId();
	}

	disableCard() :  void {
		console.log(this.gameState);
		$("#ledger-modal").modal('hide');
		// $('.'+ this.card.cardId).prop('disabled', true);
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
	}

 	loadLeaderboard() : void {
		this.ledgerService
			.getLedgerByLedgerBoardId(this.boardId)
			.subscribe(profiles => this.players = profiles);

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

}

