import {Component, OnInit} from "@angular/core";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";


import {Ledger} from "../shared/classes/ledger";
import {LedgerService} from "../shared/services/ledger.service";
import {Status} from "../shared/classes/status";
import {Stats} from "fs";


@Component({
	template: require("./ledger.component.html")
})

export class LedgerComponent implements OnInit{


	posts : Ledger[];
	postForm: FormGroup;
	status : Status = null;

	constructor(protected formBuilder : FormBuilder ,protected postService : PostService) {

	}

	ngOnInit() {
		this.loadPosts();
		this.postForm = this.formBuilder.group({
			postContent : ["", [Validators.maxLength(255) , Validators.required]],
			postTitle : ["", [Validators.maxLength(32) , Validators.required]]
		});
	}

	loadPosts() {
		this.postService.getAllPosts().subscribe(posts => this.posts = posts)
	}

	createPost() : void {
		let post = new Post(null, this.postForm.value.postContent, null, this.postForm.value.postTitle);

		this.postService.createPost(post).subscribe(status => {
			this.status = status;

			if (status.status === 200) {
				this.postForm.reset();
				this.loadPosts()
			}
		});
	}

}