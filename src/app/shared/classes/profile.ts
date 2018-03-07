export class Profile {
	constructor(
		public profileId: string,
		public profileActivationToken: string,
		public profileEmail: string,
		public profileHash: string,
		public profileName: string,
		public profilePrivilege: number,
		public profileSalt: string,
		public profileUsername: string,

	) {}
}