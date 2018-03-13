import {Component, OnInit, ViewChild} from "@angular/core";
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


declare const $: any;
@Component({
	template: require("./captain.html")
})

export class CaptainComponent implements OnInit{

	boardId: string;
	players: Profile[] = [];
	ledgerForm: FormGroup;
	status: Status = null;
	card: Card;

	@ViewChild(CardComponent) cardComponent: CardComponent;
	@ViewChild(LeaderboardComponent) leaderboardComponent: LeaderboardComponent;
	@ViewChild(BoardComponent) boardComponent: BoardComponent;

	constructor(protected ledgerService:LedgerService,protected route:ActivatedRoute,protected formBuilder: FormBuilder, protected cardService:CardService) {}

	ngOnInit() : void {
		this.boardId=this.route.snapshot.params.boardId;
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
			.subscribe(status => {this.status = status
			if (status.status===200){
				$("#ledger-modal").modal('hide');
				$('#'+ this.card.cardId).addClass('disabled');
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

}

