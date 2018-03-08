

import {Component, OnInit} from "@angular/core";
import {Router} from "@angular/router";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {SignUp} from "../shared/classes/signup";
import {CookieService} from "ng2-cookies";
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
	profile: SignUp = new SignUp(null, null, null, null, null);
	status: Status = null;

	constructor(
		private formBuilder: FormBuilder,
		private signUpService: SignUpService,
		private router: Router
	){}

	ngOnInit() : void {
		this.signUpForm = this.formBuilder.group({
			profileName: ["", [Validators.maxLength(50), Validators.required]],
			profileUsername: ["", [Validators.maxLength(64), Validators.required]],
			profileEmail: ["", [Validators.maxLength(64), Validators.required]],
			profilePassword: ["", [Validators.maxLength(250), Validators.required]],
			profileConfirmPassword: ["", [Validators.maxLength(250), Validators.required]]
		});
		this.applyFormChanges();
	}

	applyFormChanges() : void {
		this.signUpForm.valueChanges.subscribe(values => {
			for(let field in values) {
				this.profile[field] = values[field];
			}
		});
	}

	signUp() : void {
		this.signUpService.createProfile(this.profile)
			.subscribe(status => {
				this.status = status;
				if(this.status.status === 200) {
					this.signUpService.createProfile(this.profile);
					this.signUpForm.reset();
					console.log("signup successful");
					setTimeout(function(){$("#signUpForm").modal("hide");}, 5000);
				} else {
					console.log("signup fail");
				}
			});
	}
}