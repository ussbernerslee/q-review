import {Component, OnInit} from "@angular/core";
import {Router} from "@angular/router";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {AuthService} from "../shared/services/auth.service";
import {LedgerService} from "../shared/services/ledger.service";
import {JoinService} from "../shared/services/join.service";
import {Status} from "../shared/classes/status";
import {BoardService} from "../shared/services/board.service";
import {Board} from "../shared/classes/board";



@Component({
	//templateUrl: "./options.html",
	template: require("./options.html"),
	selector: "options"
})

export class OptionsComponent implements OnInit {
	joinForm: FormGroup;
	status: Status;


	//currentBoardId: string = "0c1c711e-e2e4-439d-9975-9658851b1781";
	//correct board Id a91aa671-95f8-4627-99cd-cdca3f05aa16

	constructor(private formBuilder: FormBuilder,
					private authService: AuthService,
					private ledgerService: LedgerService,
					private router: Router,
					private joinService: JoinService,
					private boardService: BoardService) {
	}


	ngOnInit(): void {
		this.joinForm = this.formBuilder.group({
			id: ["", [Validators.maxLength(36), Validators.required]]
		});
	}

	captainOption(): void {
		let board = new Board(null, null, "kmaru")
		this.boardService
			.createBoard(board)

			.subscribe(status => {
				this.status = status;
				if(this.status.status === 200) {
					this.router.navigate(["/captain/", status.message]);
					console.log("board created");
				} else {
					console.log("failed board creation");
				}
			});


	}

	studentOption(): void {
		this.joinService.joinBoard(this.joinForm.value.id)
			.subscribe(status => {
				this.status = status;
				if(this.status.status === 200) {
					console.log("joined!");
					this.router.navigate(["joined"]);
				} else {
					console.log("Invalid Board");
				}
			});
	}

}



