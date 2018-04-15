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

	@ViewChild(CardComponent) cardComponent: CardComponent;
	@ViewChild(LeaderboardComponent) leaderboardComponent: LeaderboardComponent;
	@ViewChildren(BoardComponent) gameComponents: QueryList<BoardComponent>;

	constructor(protected ledgerService:LedgerService, protected route:ActivatedRoute, protected formBuilder: FormBuilder, protected cardService:CardService) {
		this.gameState = {
			boardName: "",
			finalQuestion: "",
			cards: new Array(this.numGames),
			leaderboard: [],
			queue: []
		};
		for(let i = 0; i < this.numGames; i++) {
			this.cards[i] = [];
			this.categories[i] = null;
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

	plus () {
		let ledger: Ledger = new Ledger(this.boardId, this.card.cardId, this.ledgerForm.value.select, this.card.cardPoints, "1");
		this.ledgerService
			.postLedger(ledger)
			.subscribe(status => {
				this.status = status;
				if (status.status===200){
					$("#ledger-modal").modal('hide');
					$('.'+ this.card.cardId).prop('disabled', true);
					this.loadLeaderboard();
				}
			});
}

	subtract () {
		let ledger: Ledger = new Ledger(this.boardId, this.card.cardId, this.ledgerForm.value.select, -this.card.cardPoints, "1");
		console.log (ledger);
		console.log (this.card);

			this.ledgerService.postLedger(ledger)
			.subscribe(status => this.status = status);
		this.loadLeaderboard();

	}

	getCardId() : void {
		let array : any[];
		this.cardService.cardObserver.subscribe(cards => this.card = cards);
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

