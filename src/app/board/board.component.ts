import {Component, OnInit} from "@angular/core";

import {Board} from "../shared/classes/board";
import {BoardService} from "../shared/services/board.service";
import {Card} from "../shared/classes/card";
import {CardService} from "../shared/services/card.service";

import {Category} from "../shared/classes/category";
import {CategoryService} from "../shared/services/category.service";
import {Profile} from "../shared/classes/profile";
import {LedgerService} from "../shared/services/ledger.service";



@Component({
	selector: "game",
	template: require("./board.html")
})

export class BoardComponent implements OnInit {

	categories: Category[] = [];

	cards: Card[] = [];

	gameCategoryId: string = "0A253DC2-54A1-4985-AE66-DD5AED20B601";

	creatorId: string = "C2954660-F27B-4557-8F2D-C68E8B2D8AA8";


	constructor(protected categoryService: CategoryService, protected cardService: CardService) {}

	ngOnInit(): void {

		this.categoryService
			.getCategoryByCategoryProfileId(this.creatorId)
			.subscribe(categories => this.categories = categories);

		this.cardService
			.getCardByCardCategoryId(this.gameCategoryId)
			.subscribe(cards => this.cards = cards);

	};


}
// @Component({
// 	selector: "leaderboard",
// 	template: require("./leaderboard.html")
// })
//
// export class LeaderboardComponent implements OnInit {
//
// 	players: Profile[] = [];
//
// 	gameId: string = "0c1c711e-e2e4-439d-9975-9658851b1781";
//
// 	constructor(protected ledgerService: LedgerService) {}
//
// 	ngOnInit(): void {
//
// 		this.ledgerService
// 			.getLedgerByLedgerBoardId(this.gameId)
// 			.subscribe(profiles => this.players = profiles);
