import {Component, OnInit, EventEmitter, Output} from "@angular/core";
import {Card} from "../shared/classes/card";
import {CardService} from "../shared/services/card.service";
import {Category} from "../shared/classes/category";
import {CategoryService} from "../shared/services/category.service";
import




@Component({
	selector: "game",
	template: require("./board.html")
})

export class BoardComponent implements OnInit {

	@Output ()
		cardChange = new EventEmitter<Card>();

	categories: Category[] = [];

	cards: Card[] = [];

	gameCategoryId: string = "0A253DC2-54A1-4985-AE66-DD5AED20B601";

	creatorId: string = "C2954660-F27B-4557-8F2D-C68E8B2D8AA8";


	constructor(protected categoryService: CategoryService, protected cardService: CardService, protected jwtHelper: JwtHelper) {}


	ngOnInit(): void {

		this.categoryService
			.getCategoryByCategoryProfileId(this.creatorId)
			.subscribe(categories => this.categories = categories);

		this.cardService
			.getCardByCardCategoryId(this.gameCategoryId)
			.subscribe(cards => this.cards = cards);


	};


}

