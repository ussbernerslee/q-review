import {Component, OnInit, EventEmitter, Output} from "@angular/core";
import {Card} from "../shared/classes/card";
import {CardService} from "../shared/services/card.service";
import {Category} from "../shared/classes/category";
import {CategoryService} from "../shared/services/category.service";
import {AuthService} from "../shared/services/auth.service";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {BoardService} from "../shared/services/board.service";
import {Status} from "../shared/classes/status";


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

	creatorId: string = this.authService.decodeJwt().auth.profileId;
	boardId: Status;

	selectedCategories: string[] =[];

	selectForm: FormGroup;

	constructor(protected categoryService: CategoryService, protected cardService: CardService, protected authService: AuthService, protected formBuilder: FormBuilder,protected boardService:BoardService) {}


	ngOnInit(): void {

		this.selectForm = this.formBuilder.group({
			select:["",[Validators.required]]
		});

		this.categoryService
			.getCategoryByCategoryProfileId(this.creatorId)
			.subscribe(categories => this.categories = categories);







 	};
	dropdownId() : void {
		this.selectedCategories.push(this.selectForm.value.select);
		this.cardService
			.getCardByCardCategoryId(this.selectForm.value.select)
			.subscribe(cards => this.cards = cards);
	}


}

