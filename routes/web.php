<?php

use App\Goal;
use App\Activity;
use App\Introduction;
use App\Profile;
use App\Subject;
use Illuminate\Http\Request;


// -------------------------------------------------------------------------------------- ディスカッション ---
// 最初に表示されるページの処理
Route::get('/', "DiscussionsController@index");
// コメント登録
// Route::post('/discussion', "DiscussionsController@discussion");
// テーマ全件表示ページ
Route::get('/all_discussion', "DiscussionsController@all_discussion");
// コメント全件表示ページ
Route::get('/all_comment', "DiscussionsController@all_comment");


Route::get('/comment/store', 'DiscussionsController@store')->name('comment.add');
Route::get('/reply/store'  , 'DiscussionsController@replyStore')->name('reply.add');
// --------------------------------------------------------------------------------------------------- Goal ---
// 登録
Route::post('/index', "GoalsController@store");
// 削除
Route::delete('/goal/{goal}', "GoalsController@destroy");
// 一覧表示
// Route::get('/goalsshow/{goals}', 'GoalsController@show');
// メンバー閲覧ページ表示
Route::get('/goalslook/{alls}', 'GoalsController@look');
//編集表示
Route::get('/goalsedit/{goals}', 'GoalsController@edit');
// 編集処理
Route::post('/goalsedit', 'GoalsController@update');

// 全記録表示
Route::get('/goalall', 'GoalsController@all');
// ------------------------------------------------------------------------------------------------Goal END ---


// ----------------------------------------------------------------------------------------------- チャット ---
// メッセージ一覧を取得
Route::post('delete', 'Ajax\ChatsController@delete');
// チャット登録
Route::post('club/chat', 'Ajax\ChatsController@create');
// ------------------------------------------------------------------------------------------- チャット END ---


// ------------------------------------------------------------------------------------------------ Activity---
// 最初のページ
Route::get('/activity', "ActivitiesController@index");
// 登録
Route::post('/activities', "ActivitiesController@store");
// 削除
Route::delete('/activities/{title}', "ActivitiesController@destroy");
// 編集画面
Route::get('/activitiesedit/{alls}', 'ActivitiesController@edit');
// 編集処理
Route::post('/activitiesedit', 'ActivitiesController@update');
// グラフPage表示
Route::get('/activitygraph', 'ActivitiesController@graph');
// 全記録表示
Route::get('/activityrecord', 'ActivitiesController@record');
// TLから詳細画面表示
Route::get('/activitylook/{alls}', 'ActivitiesController@look');

// コメント登録
Route::post('/activity_comment', 'ActivitiesController@create');
// 名前押下後のMyPage表示
Route::get('/commentshow/{alls}', 'ActivitiesController@show');
// ------------------------------------------------------------------------------------------- Activity END ---


// ------------------------------------------------------------------------------------------- Notification ---
// 最初のページ
Route::get('/notification', "NotificationController@index");
// 承認
Route::get('/approval', "NotificationController@approval");
// 削除
Route::delete('/approval_delete/{approval}', "NotificationController@destroy");

// 名前押下後のMyPage表示
Route::get('/commentshow2/{applies}', 'NotificationController@show');
// ---------------------------------------------------------------------------------------- Notification END---


// ------------------------------------------------------------------------------------------------ My Page ---
// 最初のページ
Route::get('/comment', "IntroductionsController@index");
// COMMITMENTページ
Route::get('/term', "IntroductionsController@term");
// 登録
Route::post('/comments', "IntroductionsController@store");
// 削除
Route::delete('/comments/{comment}', "IntroductionsController@destroy");
// 編集画面
Route::get('/commentsedit/{comments}', 'IntroductionsController@edit');
// 編集処理
Route::post('/commentsedit', 'IntroductionsController@update');

// 友達申請
Route::post('/apply', 'IntroductionsController@create');
// Followリスト表示
Route::get('/follow', "IntroductionsController@follow");
// Followerリスト表示
Route::get('/follower', "IntroductionsController@follower");
// -------------------------------------------------------------------------------------------- My Page END----


// プロフィール-----------------------------------------------------------------
// 最初のページ
Route::get('/profile', "ProfilesController@index");
// 登録
Route::post('/profiles', "ProfilesController@store");
// 削除
Route::delete('/profiles/{profile}', "ProfilesController@destroy");
// プロフィール-----------------------------------------------------------------



// Like/Dislike-----------------------------------------------------------------
// 最初のページ
Route::get('/likedislike', "LikesController@index");
// 登録(Like)
Route::post('/likes', "LikesController@likestore");
// 削除(Like)
Route::delete('/likes/{like}', "LikesController@likedestroy");

// 登録(Dislike)
Route::post('/dislikes', "LikesController@dislikestore");
// 削除(Dislike)
Route::delete('/dislikes/{dislike}', "LikesController@dislikedestroy");

// ONE WORD登録
Route::post('/oneword', "LikesController@onewordstore");

// Like/Dislike END-------------------------------------------------------------



// ゲージ-----------------------------------------------------------------------
Route::get('ajax/gauge', 'Ajax\GaugesController@index'); 
Route::post('ajax/gauge', 'Ajax\GaugesController@create'); 
// ゲージ END-------------------------------------------------------------------






// ------------------------------------------------------------------------------------------------------- EVENT -----------------
// TOPページ表示
Route::get('/events', "EventsController@index");
// ------------------------------------------------------------------------------------------------------- EVENT END -------------









// ----------------------------------------------------------------------------- Club ---
// 最初に表示されるページの処理
Route::get('/club', "ClubsController@index");
// 登録
Route::post('/belongs', "SubjectsController@belongs");
// ----------------------------------------------------------------------------- Club ---

// ----------------------------------------------------------------------------------------------------------------------------- トライアスロン---
// TOPページ(Discussionページ表示)
Route::get('/triathlon', "Club\TriathlonController@triathlon");
// メンバー一覧ページ表示
Route::get('/triathlon_member', "Club\TriathlonController@member");

// ------------------------------------------------------------------------------------------- Discussion ---
// 登録
Route::post('/triathlondiscuss', "Club\TriathlonController@discussion_store");
// 編集表示
Route::get('/triathlon_discussion_edit/{alls}', 'Club\TriathlonController@discussion_edit');
// 編集処理
Route::get('/triathlon_discussion_update', 'Club\TriathlonController@discussion_update');
// 削除
Route::delete('/triathlon_discussions/{all}', "Club\TriathlonController@discussion_destroy");

// コメント登録
Route::post('/triathlon_discussion_comment', 'Club\TriathlonController@discussion_create');
// ---------------------------------------------------------------------------------------- Discussion END ---

// -------------------------------------------------------------------------------------------------- RULE ---
// トップ表示
Route::get('/triathlon_rule', "Club\TriathlonController@rule");
// 登録
Route::post('/triathlon_rule_store', "Club\TriathlonController@rule_store");
// 編集表示
Route::get('/triathlon_rule_edit/{rules}', 'Club\TriathlonController@rule_edit');
// 編集処理
Route::get('/triathlon_rule_update', 'Club\TriathlonController@rule_update');
// 削除
Route::delete('/triathlon_rules/{rule}', "Club\TriathlonController@rule_destroy");

// 管理者権限ページ表示
Route::get('/triathlon_admin', "Club\TriathlonController@admin");
// 管理者登録
Route::post('/triathlon_admin_store', "Club\TriathlonController@admin_store");
// ---------------------------------------------------------------------------------------------- RULE END ---

// ------------------------------------------------------------------------------------------------- EVENT ---
// TOP表示
Route::get('/triathlon_event', "Club\TriathlonController@event");
// 登録
Route::post('/triathlon_event_store', "Club\TriathlonController@event_store");
// 編集表示
Route::get('/triathlon_event_edit/{all_events}', 'Club\TriathlonController@event_edit');
// 編集処理
Route::get('/triathlon_event_update', 'Club\TriathlonController@event_update');
// 削除
Route::delete('/triathlon_events/{all_event}', "Club\TriathlonController@event_destroy");

// コメント登録
Route::post('/triathlon_event_comment', 'Club\TriathlonController@create');

// 参加可否登録
Route::get('/triathlon_participate_store', "Club\TriathlonController@participate_store");
// 参加者表示
Route::get('/triathlon_participants', "Club\TriathlonController@participants");
// ---------------------------------------------------------------------------------------------- EVENT END---
// ------------------------------------------------------------------------------------------------------------------------- トライアスロン END---


// ------------------------------------------------------------------------------------------------------------------------------ フェンシング ---
// TOPページ(Discussionページ表示)
Route::get('/fencing', "Club\FencingController@fencing");
// メンバー一覧ページ表示
Route::get('/fencing_member', "Club\FencingController@member");

// ------------------------------------------------------------------------------------------- Discussion ---
// 登録
Route::post('/fencingdiscuss', "Club\FencingController@discussion_store");
// 編集表示
Route::get('/fencing_discussion_edit/{alls}', 'Club\FencingController@discussion_edit');
// 編集処理
Route::get('/fencing_discussion_update', 'Club\FencingController@discussion_update');
// 削除
Route::delete('/fencing_discussions/{all}', "Club\FencingController@discussion_destroy");

// コメント登録
Route::post('/fencing_discussion_comment', 'Club\FencingController@discussion_create');
// ---------------------------------------------------------------------------------------- Discussion END ---

// -------------------------------------------------------------------------------------------------- RULE ---
// トップ表示
Route::get('/fencing_rule', "Club\FencingController@rule");
// 登録
Route::post('/fencing_rule_store', "Club\FencingController@rule_store");
// 編集表示
Route::get('/fencing_rule_edit/{rules}', 'Club\FencingController@rule_edit');
// 編集処理
Route::get('/fencing_rule_update', 'Club\FencingController@rule_update');
// 削除
Route::delete('/fencing_rules/{rule}', "Club\FencingController@rule_destroy");

// 管理者権限ページ表示
Route::get('/fencing_admin', "Club\FencingController@admin");
// 管理者登録
Route::post('/fencing_admin_store', "Club\FencingController@admin_store");
// ---------------------------------------------------------------------------------------------- RULE END ---

// ------------------------------------------------------------------------------------------------- EVENT ---
// TOP表示
Route::get('/fencing_event', "Club\FencingController@event");
// 登録
Route::post('/fencing_event_store', "Club\FencingController@event_store");
// 編集表示
Route::get('/fencing_event_edit/{all_events}', 'Club\FencingController@event_edit');
// 編集処理
Route::get('/fencing_event_update', 'Club\FencingController@event_update');
// 削除
Route::delete('/fencing_events/{all_event}', "Club\FencingController@event_destroy");

// コメント登録
Route::post('/fencing_event_comment', 'Club\FencingController@event_create');

// 参加可否登録
Route::get('/fencing_participate_store', "Club\FencingController@participate_store");
// 参加者表示
Route::get('/fencing_participants', "Club\FencingController@participants");
// ---------------------------------------------------------------------------------------------- EVENT END---
// ------------------------------------------------------------------------------------------------------------------ フェンシング END ---


// ----------------------------------------------------------------------------------------------------------------------------- ダンス---
// TOPページ(Discussionページ表示)
Route::get('/dance', "Club\DanceController@dance");
// メンバー一覧ページ表示
Route::get('/dance_member', "Club\DanceController@member");

// ------------------------------------------------------------------------------------------- Discussion ---
// 登録
Route::post('/dancediscuss', "Club\DanceController@discussion_store");
// 編集表示
Route::get('/dance_discussion_edit/{alls}', 'Club\DanceController@discussion_edit');
// 編集処理
Route::get('/dance_discussion_update', 'Club\DanceController@discussion_update');
// 削除
Route::delete('/dance_discussions/{all}', "Club\DanceController@discussion_destroy");

// コメント登録
Route::post('/dance_discussion_comment', 'Club\DanceController@discussion_create');
// ---------------------------------------------------------------------------------------- Discussion END ---

// -------------------------------------------------------------------------------------------------- RULE ---
// トップ表示
Route::get('/dance_rule', "Club\DanceController@rule");
// 登録
Route::post('/dance_rule_store', "Club\DanceController@rule_store");
// 編集表示
Route::get('/dance_rule_edit/{rules}', 'Club\DanceController@rule_edit');
// 編集処理
Route::get('/dance_rule_update', 'Club\DanceController@rule_update');
// 削除
Route::delete('/dance_rules/{rule}', "Club\DanceController@rule_destroy");

// 管理者権限ページ表示
Route::get('/dance_admin', "Club\DanceController@admin");
// 管理者登録
Route::post('/dance_admin_store', "Club\DanceController@admin_store");
// ---------------------------------------------------------------------------------------------- RULE END ---

// ------------------------------------------------------------------------------------------------- EVENT ---
// TOP表示
Route::get('/dance_event', "Club\DanceController@event");
// 登録
Route::post('/dance_event_store', "Club\DanceController@event_store");
// 編集表示
Route::get('/dance_event_edit/{all_events}', 'Club\DanceController@event_edit');
// 編集処理
Route::get('/dance_event_update', 'Club\DanceController@event_update');
// 削除
Route::delete('/dance_events/{all_event}', "Club\DanceController@event_destroy");

// コメント登録
Route::post('/dance_event_comment', 'Club\DanceController@create');

// 参加可否登録
Route::get('/dance_participate_store', "Club\DanceController@participate_store");
// 参加者表示
Route::get('/dance_participants', "Club\DanceController@participants");
// ---------------------------------------------------------------------------------------------- EVENT END---
// ------------------------------------------------------------------------------------------------------------------------- ダンス END---


// -------------------------------------------------------------------------------------------------------------------------- サッカー ---
// TOPページ(Discussionページ表示)
Route::get('/soccer', "Club\SoccerController@soccer");
// ----------------------------------------------------------------------------------------------------------------------- サッカー END---


// ------------------------------------------------------------------------------------------------------------------------------ 柔道 ---
// TOPページ(Discussionページ表示)
Route::get('/judo', "Club\JudoController@judo");
// --------------------------------------------------------------------------------------------------------------------------- 柔道 END---


// ---------------------------------------------------------------------------------------------------------------------- バドミントン ---
// TOPページ(Discussionページ表示)
Route::get('/budminton', "Club\BudmintonController@budminton");
// ------------------------------------------------------------------------------------------------------------------- バドミントン END---


// ------------------------------------------------------------------------------------------------------------------------------ 卓球 ---
// TOPページ(Discussionページ表示)
Route::get('/tabletennis', "Club\TableTennisController@tabletennis");
// --------------------------------------------------------------------------------------------------------------------------- 卓球 END---


// ---------------------------------------------------------------------------------------------------------------------------- テニス ---
// TOPページ(Discussionページ表示)
Route::get('/tennis', "Club\TennisController@tennis");
// ------------------------------------------------------------------------------------------------------------------------- テニス END---


// -------------------------------------------------------------------------------------------------------------------------- ラグビー ---
// TOPページ(Discussionページ表示)
Route::get('/rugby', "Club\RugbyController@rugby");
// ----------------------------------------------------------------------------------------------------------------------- ラグビー END---


// ------------------------------------------------------------------------------------------------------------------------------ 将棋 ---
// TOPページ(Discussionページ表示)
Route::get('/japanesechess', "Club\JapaneseChessController@japanesechess");
// --------------------------------------------------------------------------------------------------------------------------- 将棋 END---


// ------------------------------------------------------------------------------------------------------------------------------ 麻雀 ---
// TOPページ(Discussionページ表示)
Route::get('/majan', "Club\MajanController@majan");
// --------------------------------------------------------------------------------------------------------------------------- 麻雀 END---




Auth::routes();
Route::get('/home', 'DiscussionsController@index')->name('home');
