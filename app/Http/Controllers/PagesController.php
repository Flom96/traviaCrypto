<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Category;
use App\Question;
use App\Mquestion;
use App\User;
use App\Match;
use App\Tran;
use App\Notification;
use App\Contact;
use Blockchain\Blockchain;

class PagesController extends Controller
{
    public function demo() {
        $apiKey = "MrZYSYA6WEwELJDo";
        $apiSecret = "TEIqHIxFw8J4R2d8Lq8u1ULuMuNqvOWD";
        $data = "type=send&to=1AUJ8z5RuHRTqD1eikyfUUetzGmdWLGkpT&amount=0.1&currency=BTC&idem=9316dd16-0c05";
        $url =  "https://api.coinbase.com/v2/accounts/2aa4bf17-24f8-59ea-86fc-3981b7c2bab9/transactions/";
        $s = curl_init($url);
        curl_setopt($s, CURLOPT_URL, $url);
        curl_setopt($s, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer abd90df5f27a7b170cd775abf89d632b350b7c1c9d53e08b340cd9832ce52c2c'));
        curl_setopt($s,CURLOPT_POST,true);
        curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($s, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($s);
        var_dump($result);
        $result = json_decode($result,true);
        curl_close($s);
          
    }

    public function quiz(Request $request) {
        $id = 'quiz';
        $cat = Category::where('id', $request->category_id)->first();
        if($cat) {
            if(Auth::User()->wal_let >= $cat->price) {
                $user = User::where('id', Auth::User()->id)->update([
                    'wal_let' => Auth::User()->wal_let - $cat->price
                ]);
                if($user) {
                    $match = Match::where('category_id', $request->category_id)->where('user2_id', NULL)->where('user1_id', '!=', Auth::User()->id)->get();
                    if(count($match) == 0) {
                        $amMatch = Match::create([
                            'category_id' => $request->category_id,
                            'user1_id' => Auth::User()->id
                        ]);
                        $ques = Question::where('category_id', $amMatch->category_id)->inRandomOrder()->limit(10)->get();
                        foreach($ques as $que) {
                            Mquestion::create([
                                'match_id' => $amMatch->id,
                                'que' => $que->que,
                                'option_1' => $que->option_1,
                                'option_2' => $que->option_2,
                                'option_3' => $que->option_3,
                                'option_4' => $que->option_4,
                                'answer' => $que->answer,
                            ]);
                        };
                    }
                    else {
                        $toGetId = Match::where('category_id', $request->category_id)->where('user2_id', NULL)->where('user1_id', '!=', Auth::User()->id)->first();
                         Match::where('category_id', $request->category_id)->where('user2_id', NULL)->where('user1_id', '!=', Auth::User()->id)->first()->update([
                            'user2_id' => Auth::User()->id
                        ]);
                        $amMatch = Match::where('id', $toGetId->id)->first(); 
                    }
                    return view('pages.quiz_demo', compact('id', 'amMatch'));
                }
                
            }
            else {
                return back()->with('success', 'Insufficient fund');
            }
        }
        
        else {
            return back()->with('success', 'Error, try again later');
        }
    }

    public function quiz_pre(Request $request) {
        $id = 'quiz';
        if(Auth::User()->wal_let >= 0.01) {
            $user = User::where('id', Auth::User()->id)->update([
                'wal_let' => Auth::User()->wal_let - 0.01
            ]);
            if($user) {
                $match = Match::where('category_id', $request->category_id)->where('user2_id', NULL)->where('user1_id', '!=', Auth::User()->id)->get();
                if(count($match) == 0) {
                    $amMatch = Match::create([
                        'category_id' => $request->category_id,
                        'user1_id' => Auth::User()->id
                    ]);
                    
                    $user1 = User::where('id', $amMatch->user1_id)->first();
                    $user2 = NULL;
                }
                else {
                    $toGetId = Match::where('category_id', $request->category_id)->where('user2_id', NULL)->where('user1_id', '!=', Auth::User()->id)->first();
                     Match::where('category_id', $request->category_id)->where('user2_id', NULL)->where('user1_id', '!=', Auth::User()->id)->first()->update([
                        'user2_id' => Auth::User()->id
                    ]);
                    $amMatch = Match::where('id', $toGetId->id)->first();
                    $ques = Question::where('category_id', $amMatch->category_id)->inRandomOrder()->limit(10)->get();
                    foreach($ques as $que) {
                        Mquestion::create([
                            'match_id' => $amMatch->id,
                            'que' => $que->que,
                            'option_1' => $que->option_1,
                            'option_2' => $que->option_2,
                            'option_3' => $que->option_3,
                            'option_4' => $que->option_4,
                            'answer' => $que->answer,
                        ]);
                    };
                    $user1 = User::where('id', $amMatch->user1_id)->first();
                    $user2 = User::where('id', $amMatch->user2_id)->first(); 
                }
                return view('pages.quiz_demo', compact('id', 'amMatch', 'user1', 'user2'));
            }
            
        }
        else {
            return back()->with('success', 'Insufficient fund');
        }
    }

    public function quiz_demo() {
        $id = 'quiz';
        return view('pages.quiz', compact('id'));
    }
    public function login() {
        $id = 'login';
        return view('pages.login', compact('id'));
    }
    public function register() {
        $id = 'reg';
        return view('pages.register', compact('id'));
    }
    

    public function category() {
        $id = 'quiz';
        $cats = Category::all();
        return view('pages.category', compact('id', 'cats'));
    }

    public function pending() {
        $id = 'pending';

        $matches = Match::where(function($query) {
            $query->where('user1_id', Auth::User()->id)->where('user1_done', '!=', 10);
        })->orWhere(function($query) {
            $query->where('user2_id', Auth::User()->id)->where('user2_done', '!=', 10);
        })->get();

        return view('pages.pending', compact('id', 'matches'));
    }

    public function previous_quiz() {
        $id = 'quiz';

        $matches = Match::where(function($query) {
            $query->where('user1_id', Auth::User()->id)->where('user1_done', 10);
        })->orWhere(function($query) {
            $query->where('user2_id', Auth::User()->id)->where('user2_done', 10);
        })->get();

        return view('pages.previous', compact('id', 'matches'));
    }

    public function question(Request $request) {
        $match = Match::where('id', $request->match_id)->first();
        if($match->user1_id == Auth::User()->id) {
            $ques = Mquestion::where('match_id', $request->match_id)->where('user1', false)->first();
        }
        else {
            $ques = Mquestion::where('match_id', $request->match_id)->where('user2', false)->first();
        }
        
        
        $id = 'quiz';
        return view('pages.quiz', compact('ques', 'id', 'match'));
    }

    public function checkAnswer(Request $request){
        $ans = Mquestion::where('id', $request->mquestion_id)->first();
        $score = Match::where('id', $ans->match_id)->first();
        $price = $score->Category->price;
        $add = $price*1.8;
        $normal = $price;

        if($ans->answer == $request->chosen) {
            if($score->user1_id == Auth::User()->id) {
                Match::where('id', $ans->match_id)->update([
                    'user1_score' => $score->user1_score + 10,
                    'user1_done' => $score->user1_done + 1
                ]);
                Mquestion::where('id', $request->mquestion_id)->update([
                    'user1' => true
                ]);
                $check = Match::where('id', $ans->match_id)->first();
                if($check->user1_done >= 10) {
                    if($check->user2_done >= 10) {
                        Match::where('id', $ans->match_id)->update([
                            'taken' => true
                        ]);
                        Mquestion::where('match_id', $ans->match_id)->delete();
                        $user1 = User::where('id', $score->user1_id)->first();
                        $user2 = User::where('id', $score->user2_id)->first();
                        User::where('id', $score->user1_id)->update([
                            'taken' => $user1->taken + 1
                        ]);
                        User::where('id', $score->user2_id)->update([
                            'taken' => $user2->taken + 1
                        ]);
                        if($check->user1_score > $check->user2_score) {
                            User::where('id', $score->user1_id)->update([
                                'win' => $user1->win + 1,
                                'wal_let' => $user1->wal_let + $add
                            ]);
                            User::where('id', $score->user2_id)->update([
                                'loss' => $user2->loss + 1
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Congrats '.$user1->username.', you won the quiz agnist '.$user2->username.', '.$add.' btc has been added to ur wallet.',
                                'type' => 'success'
                            ]);
                            Notification::create([
                                'user_id' => $score->user2_id,
                                'message' => 'Oopps! '.$user2->username.', you loss the quiz to '.$user1->username.', try harder next time.',
                                'type' => 'danger'
                            ]);
                            return 'You won the quiz';
                        }
                        elseif($check->user1_score == $check->user2_score) {
                            User::where('id', $score->user1_id)->update([
                                'tie' => $user1->tie + 1,
                                'wal_let' => $user1->wal_let + $normal
                            ]);
                            User::where('id', $score->user2_id)->update([
                                'tie' => $user2->tie + 1,
                                'wal_let' => $user2->wal_let + $normal
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Wawu '.$user1->username.', you had a tie quiz with '.$user2->username.', '.$normal.' btc has been added back to ur wallet.',
                                'type' => 'info'
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Wawu '.$user2->username.', you had a tie quiz with '.$user1->username.', '.$normal.' btc has been added back to ur wallet.',
                                'type' => 'info'
                            ]);
                            return 'its a tie';
                        }
                        else {
                            User::where('id', $score->user1_id)->update([
                                'loss' => $user1->loss + 1
                            ]);
                            User::where('id', $score->user2_id)->update([
                                'win' => $user2->win + 1,
                                'wal_let' => $user2->wal_let + $add
                            ]);
                            Notification::create([
                                'user_id' => $score->user2_id,
                                'message' => 'Congrats '.$user2->username.', you won the quiz agnist '.$user1->username.', '.$add.' btc has been added to ur wallet.',
                                'type' => 'success'
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Oopps! '.$user1->username.', you loss the quiz to '.$user2->username.', try harder next time.',
                                'type' => 'danger'
                            ]);
                            return 'You lose the quiz';
                        }
                    }
                    return 'Done, await the other user to take the quiz.';
                }
            }
            else {
                Match::where('id', $ans->match_id)->update([
                    'user2_score' => $score->user2_score + 10,
                    'user2_done' => $score->user2_done + 1
                ]);
                Mquestion::where('id', $request->mquestion_id)->update([
                    'user2' => true
                ]);
                $check = Match::where('id', $ans->match_id)->first();
                if($check->user2_done >= 10) {
                    if($check->user1_done >= 10) {
                        Match::where('id', $ans->match_id)->update([
                            'taken' => true
                        ]);

                        Mquestion::where('match_id', $ans->match_id)->delete();
                        $user2 = User::where('id', $score->user2_id)->first();
                        $user1 = User::where('id', $score->user1_id)->first();
                        User::where('id', $score->user2_id)->update([
                            'taken' => $user2->taken + 1
                        ]);
                        User::where('id', $score->user1_id)->update([
                            'taken' => $user1->taken + 1
                        ]);
                        if($check->user2_score > $check->user1_score) {
                            User::where('id', $score->user2_id)->update([
                                'win' => $user2->win + 1,
                                'wal_let' => $user2->wal_let + $add
                            ]);
                            User::where('id', $score->user1_id)->update([
                                'loss' => $user1->loss + 1
                            ]);
                            Notification::create([
                                'user_id' => $score->user2_id,
                                'message' => 'Congrats '.$user2->username.', you won the quiz agnist '.$user1->username.', '.$add.' btc has been added to ur wallet.',
                                'type' => 'success'
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Oopps! '.$user1->username.', you loss the quiz to '.$user2->username.', try harder next time.',
                                'type' => 'danger'
                            ]);
                            return 'You won the quiz';
                        }
                        elseif($check->user1_score == $check->user2_score) {
                            User::where('id', $score->user2_id)->update([
                                'tie' => $user2->tie + 1,
                                'wal_let' => $user2->wal_let + $normal
                            ]);
                            User::where('id', $score->user1_id)->update([
                                'tie' => $user1->tie + 1,
                                'wal_let' => $user1->wal_let + $normal
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Wawu '.$user1->username.', you had a tie quiz with '.$user2->username.', '.$normal.' btc has been added back to ur wallet.',
                                'type' => 'info'
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Wawu '.$user2->username.', you had a tie quiz with '.$user1->username.', '.$normal.' btc has been added back to ur wallet.',
                                'type' => 'info'
                            ]);
                            return 'its a tie';
                        }
                        else {
                            User::where('id', $score->user2_id)->update([
                                'loss' => $user2->loss + 1
                            ]);
                            User::where('id', $score->user1_id)->update([
                                'win' => $user1->win + 1,
                                'wal_let' => $user1->wal_let + $add
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Congrats '.$user1->username.', you won the quiz agnist '.$user2->username.', '.$add.' btc has been added to ur wallet.',
                                'type' => 'success'
                            ]);
                            Notification::create([
                                'user_id' => $score->user2_id,
                                'message' => 'Oopps! '.$user2->username.', you loss the quiz to '.$user1->username.', try harder next time.',
                                'type' => 'danger'
                            ]);
                            return 'you loss the quiz';
                        }
                    }
                    return 'Done, await the user to take the quiz.';
                }
            }
            return 'Correct';
        }

        else {
            if($score->user1_id == Auth::User()->id) {
                Match::where('id', $ans->match_id)->update([
                    'user1_done' => $score->user1_done + 1
                ]);
                Mquestion::where('id', $request->mquestion_id)->update([
                    'user1' => true
                ]);
                $check = Match::where('id', $ans->match_id)->first();
                if($check->user1_done >= 10) {
                    if($check->user2_done >= 10) {
                        Match::where('id', $ans->match_id)->update([
                            'taken' => true
                        ]);
                        Mquestion::where('match_id', $ans->match_id)->delete();
                        $user1 = User::where('id', $score->user1_id)->first();
                        $user2 = User::where('id', $score->user2_id)->first();
                        User::where('id', $score->user1_id)->update([
                            'taken' => $user1->taken + 1
                        ]);
                        User::where('id', $score->user2_id)->update([
                            'taken' => $user2->taken + 1
                        ]);
                        if($check->user1_score > $check->user2_score) {
                            User::where('id', $score->user1_id)->update([
                                'win' => $user1->win + 1,
                                'wal_let' => $user1->wal_let + $add
                            ]);
                            User::where('id', $score->user2_id)->update([
                                'loss' => $user2->loss + 1
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Congrats '.$user1->username.', you won the quiz agnist '.$user2->username.', '.$add.' btc has been added to ur wallet.',
                                'type' => 'success'
                            ]);
                            Notification::create([
                                'user_id' => $score->user2_id,
                                'message' => 'Oopps! '.$user2->username.', you loss the quiz to '.$user1->username.', try harder next time.',
                                'type' => 'danger'
                            ]);
                            return 'You won the quiz';
                        }
                        elseif($check->user1_score == $check->user2_score) {
                            User::where('id', $score->user1_id)->update([
                                'tie' => $user1->tie + 1,
                                'wal_let' => $user1->wal_let + $normal
                            ]);
                            User::where('id', $score->user2_id)->update([
                                'tie' => $user2->tie + 1,
                                'wal_let' => $user2->wal_let + $normal
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Wawu '.$user1->username.', you had a tie quiz with '.$user2->username.', '.$normal.' btc has been added back to ur wallet.',
                                'type' => 'info'
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Wawu '.$user2->username.', you had a tie quiz with '.$user1->username.', '.$normal.' btc has been added back to ur wallet.',
                                'type' => 'info'
                            ]);
                            return 'its a tie';
                        }
                        else {
                            User::where('id', $score->user1_id)->update([
                                'loss' => $user1->loss + 1
                            ]);
                            User::where('id', $score->user2_id)->update([
                                'win' => $user2->win + 1,
                                'wal_let' => $user2->wal_let + $add
                            ]);
                            Notification::create([
                                'user_id' => $score->user2_id,
                                'message' => 'Congrats '.$user2->username.', you won the quiz agnist '.$user1->username.', '.$add.' btc has been added to ur wallet.',
                                'type' => 'success'
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Oopps! '.$user1->username.', you loss the quiz to '.$user2->username.', try harder next time.',
                                'type' => 'danger'
                            ]);
                            return 'You lose the quiz';
                        }
                    }
                    return 'Done, await the user to take the quiz.';
                }
            }
            else {
                Match::where('id', $ans->match_id)->update([
                    'user2_done' => $score->user2_done + 1
                ]);
                Mquestion::where('id', $request->mquestion_id)->update([
                    'user2' => true
                ]);
                $check = Match::where('id', $ans->match_id)->first();
                if($check->user2_done >= 10) {
                    if($check->user1_done >= 10) {
                        Match::where('id', $ans->match_id)->update([
                            'taken' => true
                        ]);

                        Mquestion::where('match_id', $ans->match_id)->delete();
                        $user2 = User::where('id', $score->user2_id)->first();
                        $user1 = User::where('id', $score->user1_id)->first();
                        User::where('id', $score->user2_id)->update([
                            'taken' => $user2->taken + 1
                        ]);
                        User::where('id', $score->user1_id)->update([
                            'taken' => $user1->taken + 1
                        ]);
                        if($check->user2_score > $check->user1_score) {
                            User::where('id', $score->user2_id)->update([
                                'win' => $user2->win + 1,
                                'wal_let' => $user2->wal_let + $add
                            ]);
                            User::where('id', $score->user1_id)->update([
                                'loss' => $user1->loss + 1
                            ]);
                            Notification::create([
                                'user_id' => $score->user2_id,
                                'message' => 'Congrats '.$user2->username.', you won the quiz agnist '.$user1->username.', '.$add.' btc has been added to ur wallet.',
                                'type' => 'success'
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Oopps! '.$user1->username.', you loss the quiz to '.$user2->username.', try harder next time.',
                                'type' => 'danger'
                            ]);
                            return 'You won the quiz';
                        }
                        elseif($check->user1_score == $check->user2_score) {
                            User::where('id', $score->user2_id)->update([
                                'tie' => $user2->tie + 1,
                                'wal_let' => $user2->wal_let + $normal
                            ]);
                            User::where('id', $score->user1_id)->update([
                                'tie' => $user1->tie + 1,
                                'wal_let' => $user1->wal_let + $normal
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Wawu '.$user1->username.', you had a tie quiz with '.$user2->username.', '.$normal.' btc has been added back to ur wallet.',
                                'type' => 'info'
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Wawu '.$user2->username.', you had a tie quiz with '.$user1->username.', '.$normal.' btc has been added back to ur wallet.',
                                'type' => 'info'
                            ]);
                            return 'its a tie';
                        }
                        else {
                            User::where('id', $score->user2_id)->update([
                                'loss' => $user2->loss + 1
                            ]);
                            User::where('id', $score->user1_id)->update([
                                'win' => $user1->win + 1,
                                'wal_let' => $user1->wal_let + $add
                            ]);
                            Notification::create([
                                'user_id' => $score->user1_id,
                                'message' => 'Congrats '.$user1->username.', you won the quiz agnist '.$user2->username.', '.$add.' btc has been added to ur wallet.',
                                'type' => 'success'
                            ]);
                            Notification::create([
                                'user_id' => $score->user2_id,
                                'message' => 'Oopps! '.$user2->username.', you loss the quiz to '.$user1->username.', try harder next time.',
                                'type' => 'danger'
                            ]);
                            return 'you loss the quiz';
                        }
                    }
                    return 'Done, await the user to take the quiz.';
                }
            }
            return 'Incorrect';
        }
    }

    public function noAnswer(Request $request) {
        $ans = Mquestion::where('id', $request->mquestion_id)->first();
        $score = Match::where('id', $ans->match_id)->first();
        $price = $score->Category->price;
        $add = $price*1.8;
        $normal = $price;

        if($score->user1_id == Auth::User()->id) {
            Match::where('id', $ans->match_id)->update([
                'user1_done' => $score->user1_done + 1
            ]);
            Mquestion::where('id', $request->mquestion_id)->update([
                'user1' => true
            ]);
            $check = Match::where('id', $ans->match_id)->first();
            if($check->user1_done >= 10) {
                if($check->user2_done >= 10) {
                    Match::where('id', $ans->match_id)->update([
                        'taken' => true
                    ]);
                    Mquestion::where('match_id', $ans->match_id)->delete();
                    $user1 = User::where('id', $score->user1_id)->first();
                    $user2 = User::where('id', $score->user2_id)->first();
                    User::where('id', $score->user1_id)->update([
                        'taken' => $user1->taken + 1
                    ]);
                    User::where('id', $score->user2_id)->update([
                        'taken' => $user2->taken + 1
                    ]);
                    if($check->user1_score > $check->user2_score) {
                        User::where('id', $score->user1_id)->update([
                            'win' => $user1->win + 1,
                            'wal_let' => $user1->wal_let + $add
                        ]);
                        User::where('id', $score->user2_id)->update([
                            'loss' => $user2->loss + 1 
                        ]);
                        Notification::create([
                            'user_id' => $score->user1_id,
                            'message' => 'Congrats '.$user1->username.', you won the quiz agnist '.$user2->username.', '.$add.' btc has been added to ur wallet.',
                            'type' => 'success'
                        ]);
                        Notification::create([
                            'user_id' => $score->user2_id,
                            'message' => 'Oopps! '.$user2->username.', you loss the quiz to '.$user1->username.', try harder next time.',
                            'type' => 'danger'
                        ]);
                        return 'You won the quiz';
                    }
                    elseif($check->user1_score == $check->user2_score) {
                        User::where('id', $score->user1_id)->update([
                            'tie' => $user1->tie + 1,
                            'wal_let' => $user1->wal_let + $normal
                        ]);
                        User::where('id', $score->user2_id)->update([
                            'tie' => $user2->tie + 1,
                            'wal_let' => $user2->wal_let + $normal
                        ]);
                        Notification::create([
                            'user_id' => $score->user1_id,
                            'message' => 'Wawu '.$user1->username.', you had a tie quiz with '.$user2->username.', '.$normal.' btc has been added back to ur wallet.',
                            'type' => 'info'
                        ]);
                        Notification::create([
                            'user_id' => $score->user1_id,
                            'message' => 'Wawu '.$user2->username.', you had a tie quiz with '.$user1->username.', '.$normal.' btc has been added back to ur wallet.',
                            'type' => 'info'
                        ]);
                        return 'its a tie';
                    }
                    else {
                        User::where('id', $score->user1_id)->update([
                            'loss' => $user1->loss + 1
                        ]);
                        User::where('id', $score->user2_id)->update([
                            'win' => $user2->win + 1,
                            'wal_let' => $user2->wal_let + $add
                        ]);
                        Notification::create([
                            'user_id' => $score->user2_id,
                            'message' => 'Congrats '.$user2->username.', you won the quiz agnist '.$user1->username.', '.$add.' btc has been added to ur wallet.',
                            'type' => 'success'
                        ]);
                        Notification::create([
                            'user_id' => $score->user1_id,
                            'message' => 'Oopps! '.$user1->username.', you loss the quiz to '.$user2->username.', try harder next time.',
                            'type' => 'danger'
                        ]);
                        return 'You lose the quiz';
                    }
                }
                return 'Done, await the user to take the quiz.';
            }
        }
        else {
            Match::where('id', $ans->match_id)->update([
                'user2_done' => $score->user2_done + 1
            ]);
            Mquestion::where('id', $request->mquestion_id)->update([
                'user2' => true
            ]);
            $check = Match::where('id', $ans->match_id)->first();
            if($check->user2_done >= 10) {
                if($check->user1_done >= 10) {
                    Match::where('id', $ans->match_id)->update([
                        'taken' => true
                    ]);

                    Mquestion::where('match_id', $ans->match_id)->delete();
                    $user2 = User::where('id', $score->user2_id)->first();
                    $user1 = User::where('id', $score->user1_id)->first();
                    User::where('id', $score->user2_id)->update([
                        'taken' => $user2->taken + 1
                    ]);
                    User::where('id', $score->user1_id)->update([
                        'taken' => $user1->taken + 1
                    ]);
                    if($check->user2_score > $check->user1_score) {
                        User::where('id', $score->user2_id)->update([
                            'win' => $user2->win + 1,
                            'wal_let' => $user2->wal_let + $add
                        ]);
                        User::where('id', $score->user1_id)->update([
                            'loss' => $user1->loss + 1
                        ]);
                        Notification::create([
                            'user_id' => $score->user2_id,
                            'message' => 'Congrats '.$user2->username.', you won the quiz agnist '.$user1->username.', '.$add.' btc has been added to ur wallet.',
                            'type' => 'success'
                        ]);
                        Notification::create([
                            'user_id' => $score->user1_id,
                            'message' => 'Oopps! '.$user1->username.', you loss the quiz to '.$user2->username.', try harder next time.',
                            'type' => 'danger'
                        ]);
                        return 'You won the quiz';
                    }
                    elseif($check->user1_score == $check->user2_score) {
                        User::where('id', $score->user2_id)->update([
                            'tie' => $user2->tie + 1,
                            'wal_let' => $user2->wal_let + $normal
                        ]);
                        User::where('id', $score->user1_id)->update([
                            'tie' => $user1->tie + 1,
                            'wal_let' => $user1->wal_let + $normal
                        ]);
                        Notification::create([
                            'user_id' => $score->user1_id,
                            'message' => 'Wawu '.$user1->username.', you had a tie quiz with '.$user2->username.', '.$normal.' btc has been added back to ur wallet.',
                            'type' => 'info'
                        ]);
                        Notification::create([
                            'user_id' => $score->user1_id,
                            'message' => 'Wawu '.$user2->username.', you had a tie quiz with '.$user1->username.', '.$normal.' btc has been added back to ur wallet.',
                            'type' => 'info'
                        ]);
                        return 'its a tie';
                    }
                    else {
                        User::where('id', $score->user2_id)->update([
                            'loss' => $user2->loss + 1
                        ]);
                        User::where('id', $score->user1_id)->update([
                            'win' => $user1->win + 1,
                            'wal_let' => $user1->wal_let + $add
                        ]);
                        Notification::create([
                            'user_id' => $score->user1_id,
                            'message' => 'Congrats '.$user1->username.', you won the quiz agnist '.$user2->username.', '.$add.' btc has been added to ur wallet.',
                            'type' => 'success'
                        ]);
                        Notification::create([
                            'user_id' => $score->user2_id,
                            'message' => 'Oopps! '.$user2->username.', you loss the quiz to '.$user1->username.', try harder next time.',
                            'type' => 'danger'
                        ]);
                        return 'you loss the quiz';
                    }
                }
                return 'Done, await the user to take the quiz.';
            }
        }
        return 'ok';
    }

    public function profile() {
        $id = 'profile';

        return view('pages.profile', compact('id'));
    }

    public function updateImg(Request $request) {
        if($request->hasFile('file')) {
            $file = $request->file->getClientOriginalName();
            $filename_without_extension = pathinfo($file, PATHINFO_FILENAME);
            $extension = $request->file->getClientOriginalExtension();
            $filename_to_store = $filename_without_extension.'_'.time().'.'.$extension;
            $path = $request->file->move('userImages/', $filename_to_store);
            User::where('id', Auth::User()->id)->update([
                'img' => $filename_to_store
            ]);
            return '/userImages/'.$filename_to_store;
        }
        else {
            return 'yes';
        }
    }

    public function editProfile() {
        $id = 'profile';
        return view('pages.editProfile', compact('id'));
    }

    public function updateProfile(Request $request) {
        $user = User::where('id', Auth::User()->id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email
        ]);
        return back()->with('success', 'updated');
    }

    public function changePassword() {
        $id = 'profile';
        return view('pages.changePassword', compact('id'));
    }

    public function updatePassword(Request $request) {
        if(Hash::check($request->old_password, Auth::User()->password)) {
            if($request->new_password == $request->password_confirmation) {
                User::where('id', Auth::User()->id)->update([
                    'password' => bcrypt($request->new_password)
                ]);
                return back()->with('success', 'Password successfully changed');
            }
            else {
                return back()->with('success', 'Passwords do not match!!');
            }
        }
        else {
            return back()->with('success', 'Incorrect password!!');
        }
    }

    public function pay() {

        $secret = 'Ayt48Rbu1uji90vdq55J';

        $my_xpub = 'xpub6BnapLD2cZ97DZb4uPJxPsFWzfAPGoXWJmY5GYQ15AGhx1PrNUrm97zMcks1gkZ723Pp6LGeGY4L5udcUCNV5YjXuMfGxHskJWvzferRrsK';
        $my_api_key = 'a62b05e0-3c68-48c0-88a3-f1490efd3b81';

        $invoice = uniqid();

        $my_callback_url = 'http://www.triviacrypto.tech/received?invoice='.$invoice.'&user_id='.Auth::User()->id.'&secret='.$secret;

        $root_url = 'https://api.blockchain.info/v2/receive';

        $parameters = 'xpub=' .$my_xpub. '&callback=' .urlencode($my_callback_url). '&key=' .$my_api_key.'&gap_limit=100';

        $r_url = $root_url.'?'.$parameters;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $r_url);
        $ccc = curl_exec($ch);
        $json = json_decode($ccc, true);
        $payTo = $json['address'];

        return  $payTo;
    }

    public function sendBitcoin(Request $request) {
        if(!is_numeric($request->amount)) {
            return back()->with('success', 'Amount must be a numerical value');
        }
        elseif($request->amount <= 0) {
            return back()->with('success', 'Amount must be a positive value');
        }
        elseif($request->amount > Auth::User()->wal_let) {
            return back()->with('success', 'Amount must be a less than your wallet balance');
        }
        elseif($request->amount < 0.001) {
            return back()->with('success', 'Mininmum withdrawal is 0.001 btc');
        }
        elseif($request->address == "") {
            return back()->with('success', 'Bitcoin Address field empty');
        }
        else {
            $fee = 0.1*$request->amount;
            $total = $fee + $request->amount;
            $user = User::where('id', Auth::User()->id)->update([
                'wal_let' => Auth::User()->wal_let - $total
            ]);
            if($user) {
                    Tran::create([
                        'type' => 'debit',
                        'user_id' => Auth::User()->id,
                        'amount' => $request->amount,
                        'fee' => $fee,
                        'transaction_hash' => 'debit',
                        'status' => false,
                        'address' => $request->address
                    ]);
                return back()->with('success', 'Transaction successful, you will receive your bitcoin as soon as it is approved by admin');
            }
            else{
                return back()->with('success', 'Try again later');
            }
        }
    }

    public function updateSend(Request $request) {
        if(!is_numeric($request->amount)) {
            return 'Amount must be a numerical value';
        }
        elseif($request->amount <= 0) {
            return 'Amount must be a positive value';
        }
        elseif($request->amount > Auth::User()->wal_let) {
            return 'Amount must be a less than your wallet balance';
        }
        elseif($request->amount < 0.001) {
            return 'Mininmum withdrawal is 0.001 btc';
        }
        else {
            $fee = 0.1*$request->amount;
            return 'Fee Charge: '.$fee.' btc';
        }
    }

    public function received(Request $request) {
        $secret = 'Ayt48Rbu1uji90vdq55J';
        if($request->secret != $secret) {
            
            return 'stop doing that';
        }
        else {
            $amount = $request->value / 100000000;
            $id = $request->user_id;
            $trans = Tran::create([
                'type' => 'credit',
                'user_id' => $id,
                'amount' => $amount,
                'transaction_hash' => $request->transaction_hash
            ]);
            $user = User::where('id', $id)->first();
            User::where('id', $id)->update([
                'wal_let' => $user->wal_let + $amount
            ]);
            Notification::create([
                'user_id' => Auth::User()->id,
                'message' => 'Payment of '.$amount.' btc was successful and your wallet has been updated',
                'type' => 'success'
            ]);
            return "*ok*";
        }
    }

    public function credit() {
        $id = 'tran';
        return view('pages.credit', compact('id'));
    }

    public function debit() {

    }

    public function transaction_history() {
        $id = 'tran';
        $trans = Tran::where('user_id', Auth::User()->id)->orderBy('created_at', 'DESC')->paginate(20);
        return view('pages.history', compact('id', 'trans'));
    }

    public function notification() {
        $id = 'not';
        $nots = Notification::where('user_id', Auth::User()->id)->orderBy('created_at', 'DESC')->paginate(10);
        Notification::where('user_id', Auth::User()->id)->update([
            'new' => false
        ]);
        return view('pages.notify', compact('id', 'nots'));
    }

    public function contact(Request $request) {
        $contact = Contact::create($request->all());
        if($contact) {
            return back()->with('success', 'Message sent');
        }
    }

}
