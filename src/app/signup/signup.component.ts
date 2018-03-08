

import {Component, OnInit} from "@angular/core";
import {Router} from "@angular/router";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {SignUp} from "../shared/classes/signup";

import {SignUpService} from "../shared/services/signup.service";
import {Status} from "../shared/classes/status";


//enable jquery $ alias
declare const $: any;

@Component({
	//templateUrl: "./signup.html",
	template: require("./signup.html"),
	selector: "signup"
})

export class SignUpComponent implements OnInit{

	signUpForm: FormGroup;

	status: Status = null;

	constructor(
		private formBuilder: FormBuilder,
		private signUpService: SignUpService,
		private router: Router
	){}

	ngOnInit() : void {
		this.signUpForm = this.formBuilder.group({
			profileName: ["", [Validators.maxLength(50), Validators.required]],
			profileUserName: ["", [Validators.maxLength(64), Validators.required]],
			profileEmail: ["", [Validators.maxLength(64), Validators.required]],
			profilePassword: ["", [Validators.maxLength(250), Validators.required]],
			profileConfirmPassword: ["", [Validators.maxLength(250), Validators.required]]
		});

	}



	signUp() : void {
		let profile: SignUp = new SignUp(this.signUpForm.value.profileEmail, this.signUpForm.value.profileName, this.signUpForm.value.profilePassword, this.signUpForm.value.profileConfirmPassword, this.signUpForm.value.profileUserName);
		this.signUpService.createProfile(profile)
			.subscribe(status => {
				this.status = status;
				if(this.status.status === 200) {
					this.signUpService.createProfile(profile);
					this.signUpForm.reset();
					console.log("signup successful");
					setTimeout(function(){$("#signUpForm").modal("hide");}, 5000);
				} else {
					console.log("signup fail");
				}
			});
	}
}