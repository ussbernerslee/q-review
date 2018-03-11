import {Component, OnInit} from "@angular/core";
import {Router} from "@angular/router";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Ledger} from "../shared/classes/ledger";
import {AuthService} from "../shared/services/auth.service";
import {LedgerService} from "../shared/services/ledger.service";


@Component({
	//templateUrl: "./options.html",
	template: require("./options.html"),
	selector: "options"
})

export class OptionsComponent implements OnInit {
	joinForm: FormGroup;

	joinId: string = "fa41de8f-f69b-47cd-8b71-6fff8a3a1185";

	playerId: string = this.authService.decodeJwt().auth.profileId;

	//currentBoardId: string = "0c1c711e-e2e4-439d-9975-9658851b1781";

	constructor(
		private formBuilder: FormBuilder,
		protected authService: AuthService,
		protected ledgerService: LedgerService,
		private router: Router) {}

	ngOnInit() : void {
		this.joinForm = this.formBuilder.group({
		});
	}
captainOption() : void {
	this.router.navigate(["board"]);

		}
studentOption() : void {
	let ledger: Ledger = new Ledger(this.joinForm.value.id, this.joinId, this.playerId, 0, "1");
	this.ledgerService.postLedger(ledger);
		this.router.navigate(["student"]);
		}
}