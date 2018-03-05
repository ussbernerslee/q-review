import {Injectable} from "@angular/core";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs/Observable";
import {Status} from "../classes/status";
import {Ledger} from "../classes/ledger";

@Injectable()
export class LedgerService {
	constructor(protected http : HttpClient) {

	}

	private ledgerUrl = "api/ledger/";




	//preform the post to initiate ledger
	postLedger(ledger:Ledger) : Observable<Status> {
		return(this.http.post<Status>(this.ledgerUrl, ledger));
	}

// call to the ledger API and GET ledgerPoints based on its ledgerBoardId
	getLedger(ledgerBoardId : string) : Observable<Ledger> {
		return (this.http.get<Ledger>(this.ledgerUrl + ledgerBoardId));
	}
}
	//return(this.http.get<Foo[]>(this.fooUrl, {params: new HttpParms().set("fuzzyId", "senator-arlo").set("numLives", 9)}))

