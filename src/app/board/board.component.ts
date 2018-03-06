import {Component, OnInit} from "@angular/core";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";

// import {Board} from "../shared/classes/board";
// import {BoardService} from "../shared/services/board.service";
// import {Card} from "../shared/classes/card";
// import {CardService} from "../shared/services/card.service";
// import {Category} from "../shared/classes/category";
// import {CategoryService} from "../shared/services/category.service";
// import {Status} from "../shared/classes/status";
// import {Stats} from "fs";


@Component({
	template: require("./board.html")
})

export class BoardComponent {


	// board : Board[];
	// boardForm: FormGroup;
	// status : Status = null;
	//
	//
	//
	// ngOnInit() {
	// 	this.loadPosts();
	// 	this.boardForm = this.formBuilder.group({
	// 		boardName : ["", [Validators.maxLength(64) , Validators.required]],
	// 	});
	// }
	//
	// loadBoard() {
	// 	this.boardService.getAllPosts().subscribe(posts => this.posts = posts)
	// }
	//
	// createPost() : void {
	// 	let post = new Post(null, this.postForm.value.postContent, null, this.postForm.value.postTitle);
	//
	// 	this.postService.createPost(post).subscribe(status => {
	// 		this.status = status;
	//
	// 		if (status.status === 200) {
	// 			this.postForm.reset();
	// 			this.loadPosts()
	// 		}
	// 	});
	// }

}