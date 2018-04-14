import {ActionReducer} from "@ngrx/store";
import {BUZZ_IN, BUZZ_OFF, SCORE, FINAL, CaptainOrder} from "../shared/classes/captain.order";


export const CaptainReducer: ActionReducer<any> = (state = [], action: CaptainOrder) => {
	switch(action.type) {
		case BUZZ_IN:
			if(state.queue.findIndex((player: any) => player.username === action.payload.username) === -1) {
				let newQueue = state.queue.sort((player1: any, player2: any) => Math.sign(player1.timestamp - player2.timestamp));
				return(Object.assign({}, state, {queue: newQueue}));
			}
			return state;
		case BUZZ_OFF:
			return(Object.assign({}, state, {queue: []}));
		case SCORE:
			return(Object.assign({}, state, {leaderboard: action.payload}));
		case FINAL:
			return state;
		default:
			return state;
	}
};