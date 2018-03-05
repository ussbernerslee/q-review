import {Injectable} from "@angular/core";
import {HttpClient, HttpParams} from "@angular/common/http";
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
	getLedgerByLedgerBoardId(ledgerBoardId : string) : Observable<Ledger[]> {
		return(this.http.get<Ledger[]>(this.ledgerUrl, {params: new HttpParams().set("ledgeBoardId", ledgerBoardId)}));
	}
}


