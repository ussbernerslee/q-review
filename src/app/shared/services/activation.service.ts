import {Injectable} from "@angular/core";
import {Status} from "../classes/status";
import {Observable} from "rxjs/Observable";
import {Activation} from "../classes/activation.ts";
import {HttpClient} from "@angular/common/http";

@Injectable()
export class SignUpService {
	constructor(protected http: HttpClient) {

	}

	private activationUrl = "api/activation/";

	createProfile(activation: Activation) : Observable<Status> {
		return(this.http.post<Status>(this.activationUrl, activation));
	}
}