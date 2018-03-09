import {Component, OnInit, ViewChild} from "@angular/core";
import {CardComponent} from "../card/card.component";
import {LeaderboardComponent} from "../leaderboard/leaderboard.component";
import {BoardComponent} from "../board/board.component";

@Component({
	template: require("./captain.html")
})

export class CaptainComponent {

	@ViewChild(CardComponent) cardComponent: CardComponent;
	@ViewChild(LeaderboardComponent) leaderboardComponent: LeaderboardComponent;
	@ViewChild(BoardComponent) boardComponent: BoardComponent;


	ngOnInit() : void {}







}

