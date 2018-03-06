import {Injectable} from "@angular/core";
import {HttpClient, HttpParams} from "@angular/common/http";

import {Status} from "../classes/status";
import {Category} from "../classes/category";
import {Observable} from "rxjs/Observable";

@Injectable ()
export class CategoryService {

	constructor(protected http : HttpClient) {}

	//api endpoint
	private categoryUrl = "api/category/";

	//call to the category API and create the category This is currently a PUT, but does it need to be a POST?
	editCategory(category: Category) : Observable<Status> {
		return(this.http.put<Status>(this.categoryUrl + category.categoryId, category));
	}

	//call to the board API and create the category
	createCategory(category: Category) : Observable<Status> {
		return(this.http.post<Status>(this.categoryUrl , category));
	}

	//call the category API and get a category object by its Id
	getCategory(categoryId: string) : Observable<Category> {
		return(this.http.get<Category>(this.categoryUrl, {params: new HttpParams().set("categoryId", categoryId)}));
	}

	//call the category API and get the Category by Category Profile Id
	getCategoryByCategoryProfileId(categoryProfileId: string) : Observable<Category> {
		return(this.http.get<Category>(this.categoryUrl, {params: new HttpParams().set("categoryProfileId", categoryProfileId)}));
	}

	//call the category API and get the Category by Category Name
	getCategoryByCategoryName(categoryName: string) : Observable<Category> {
		return(this.http.get<Category>(this.categoryUrl, {params: new HttpParams().set("categoryName", categoryName)}));
	}

	// connect to the category API and delete the category
	deleteCategory(id: string) : Observable<Status> {
		return(this.http.delete<Status>(this.categoryUrl + id));
	}

}