import {Action, ActionReducer} from "@ngrx/store";
import {Board} from "../shared/classes/board";


export const CaptainReducer: ActionReducer<Board[]> = (state = [], action: Action) => {
	switch(action.type) {
		default:
			return state;
	}
};