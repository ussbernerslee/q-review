import {Component, OnInit} from "@angular/core";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Status} from "../shared/classes/status";
import {SignIn} from "../shared/classes/sign.in";

import {Ledger} from "../shared/classes/ledger";
import {LedgerService} from "../shared/services/ledger.service";
import {Profile} from "../shared/classes/profile";

//import {Board} from "../shared/classes/board";
//import {BoardService} from "../shared/services/board.service";
//import {Card} from "../shared/classes/card";
//import {CardService} from "../shared/services/card.service";
// import {Category} from "../shared/classes/category";
// import {CategoryService} from "../shared/services/category.service";
// import {Status} from "../shared/classes/status";
// import {Stats} from "fs";


@Component({
	selector: "leaderboard",
	template: require("./leaderboard.html")
})

export class leaderboardComponent implements OnInit {

}