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


@Component({
	template: require("./captain.html")
})

export class CaptainComponent implements OnInit{

	boardId: string;
	players: Profile[] = [];
	ledgerForm: FormGroup;
	status: Status = null;

	@ViewChild(CardComponent) cardComponent: CardComponent;
	@ViewChild(LeaderboardComponent) leaderboardComponent: LeaderboardComponent;
	@ViewChild(BoardComponent) boardComponent: BoardComponent;

	constructor(protected ledgerService:LedgerService,protected route:ActivatedRoute,protected formBuilder: FormBuilder) {}

	ngOnInit() : void {
		this.boardId=this.route.snapshot.params.boardId;
		this.ledgerService
			.getLedgerByLedgerBoardId(this.boardId)
			.subscribe(profiles => this.players = profiles);

		this.ledgerForm = this.formBuilder.group({
			select:["",[Validators.required]]
		});

	}

	plus (card : Card) {
		let ledger: Ledger = new Ledger(this.boardId, card.cardId, this.ledgerForm.value.select, card.cardPoints, "1");
		this.ledgerService
			.postLedger(ledger)
			.subscribe(status => this.status = status);
}

	subtract (card : Card) {
		let ledger: Ledger = new Ledger(this.boardId, card.cardId, this.ledgerForm.value.select, -card.cardPoints, "1");
		this.ledgerService
			.postLedger(ledger)
			.subscribe(status => this.status = status);
	}

// close modal, deactivate card

}

