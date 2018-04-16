import {Component, OnInit} from "@angular/core";
import {Status} from "../shared/classes/status";
import {PubNubAngular} from "pubnub-angular2";
import {JoinService} from "../shared/services/join.service";
import {ActivatedRoute} from "@angular/router";


@Component({
	selector: "joined",
	template: require("./joined.html")
})

export class JoinedComponent implements OnInit {
	boardId: string;


	constructor(protected pubnub: PubNubAngular, protected route: ActivatedRoute) {}

	ngOnInit(): void {
		this.boardId = this.route.snapshot.params.boardId;
	}




}