import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { RouterModule, Routes } from '@angular/router';

import { AppComponent } from './app.component';
import { ArticlesComponent } from './components/articles/articles.component';
import { ArticleItemComponent } from './components/article-item/article-item.component';
import { UpdateArticleComponent } from './components/update-article/update-article.component';

import { ArticleDetailComponent } from './components/article-detail/article-detail.component';

const appRoutes: Routes = [
  { path: '', component: ArticlesComponent },
  { path: 'update/:id', component: UpdateArticleComponent },
  { path: 'detail/:id', component: ArticleDetailComponent },
];

@NgModule({
  declarations: [
    AppComponent,
    ArticlesComponent,
    ArticleItemComponent,
    UpdateArticleComponent,
    ArticleDetailComponent,
  ],
  imports: [
    BrowserModule,
    FormsModule,
    RouterModule.forRoot(appRoutes, { enableTracing: true }),
  ],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
