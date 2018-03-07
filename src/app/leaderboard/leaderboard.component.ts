import {Component, OnInit} from "@angular/core";
import {Status} from "../shared/classes/status";
import {LedgerService} from "../shared/services/ledger.service";
import {Profile} from "../shared/classes/profile";


@Component({
	selector: "leaderboard",
	template: require("./leaderboard.html")
})

export class LeaderboardComponent implements OnInit {

	players: Profile[] = [];

	gameId: string = "0c1c711e-e2e4-439d-9975-9658851b1781";

	constructor(protected ledgerService: LedgerService) {}

	ngOnInit(): void {

		this.ledgerService
			.getLedgerByLedgerBoardId(this.gameId)
			.subscribe(profiles => this.players = profiles);

	}




}