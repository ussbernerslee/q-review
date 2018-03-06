
import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {SessionService} from "../shared/services/session.service";
import {LedgerService} from "../shared/services/ledger.service";
import {Ledger} from "../shared/classes/ledger";
import "rxjs/add/observable/from";
import "rxjs/add/operator/switchMap";


@Component({
	//templateUrl: "./leaderboard.html"
	template: require("./leaderboard.html")
})

export class LeaderboardComponent {

	/*	profile: Profile = new Profile(0, "", "", "", "", "");
		status: Status = null;
		constructor(private profileService: ProfileService, private route: ActivatedRoute) {}
		ngOnInit() : void {
			this.route.params
				.switchMap((params : Params) => this.profileService.getProfile(+params["id"]))
				.subscribe(reply => this.profile = reply);
		}*/
}

