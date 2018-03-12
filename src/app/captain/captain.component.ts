import {Component, OnInit, ViewChild} from "@angular/core";
import {CardComponent} from "../card/card.component";
import {LeaderboardComponent} from "../leaderboard/leaderboard.component";
import {BoardComponent} from "../board/board.component";
import {LedgerService} from "../shared/services/ledger.service";
import {Profile} from "../shared/classes/profile";
import {ActivatedRoute} from "@angular/router";


@Component({
	template: require("./captain.html")
})

export class CaptainComponent implements OnInit{

	boardId: string;
	players: Profile[] = [];

	@ViewChild(CardComponent) cardComponent: CardComponent;
	@ViewChild(LeaderboardComponent) leaderboardComponent: LeaderboardComponent;
	@ViewChild(BoardComponent) boardComponent: BoardComponent;

	constructor(protected ledgerService:LedgerService,protected route:ActivatedRoute) {}

	ngOnInit() : void {
		this.boardId=this.route.snapshot.params.boardId;
		this.ledgerService
			.getLedgerByLedgerBoardId(this.boardId)
			.subscribe(profiles => this.players = profiles);

	}







}

