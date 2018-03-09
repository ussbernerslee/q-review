import {CardService} from "../shared/services/card.service";
import {CategoryService} from "../shared/services/category.service";
import {Component, OnInit} from "@angular/core";
import {Card} from "../shared/classes/card";
import {Category} from "../shared/classes/category";

@Component({
	selector: "card",
	template: require("./card.html")
})

export class CardComponent {

	card: Card = new Card(null, null, null, null, null);
	category: Category = new Category(null, null, null);
	categoryId: string = "dd02034e-2f70-4ca8-a4bc-416c3eaa0db3";
	cardId: string = "155456a2-5926-4071-bfa8-5e21fb5402ae";

	constructor(protected cardService: CardService, protected categoryService: CategoryService) {}


	getCard(){
		this.cardService
			.getCard(this.cardId)
			.subscribe(card => this.card = card);
	}

	getCategory() {
		this.categoryService
			.getCategory(this.categoryId)
			.subscribe(category => this.category = category);
	}

}