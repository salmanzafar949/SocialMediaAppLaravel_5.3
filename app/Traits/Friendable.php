<?php

namespace App\Traits;
use App\Friendship;

trait Friendable
{
    public function add_friend($user_requested_id)
    {
        $friendship = Friendship::create([

            'requester' => $this->id,
            'user_requested' => $user_requested_id 
        ]);

        if($friendship)
        {
            return response()->json($friendship, 200);
        }
            // Returning Response with bad status
         return response()->json('failure', 501);
    }

    public function accept_friend($requester)
    {
            $friendship = Friendship::where('requester', $requester)
                           ->where('user_requested', $this->id)
                           ->first();

            if($friendship)
            {
                $friendship->update([

                      'status' => 1

                ]);

                return response()->json($friendship,200);
            }

            return response()->json('fail',501);
    }


    public function friends()
    {
        $friends = array();
        $f1 = Frienship::where('status', 1)
                    ->where('requetser', $this->id)
                    ->get();
        foreach($f1 as $frienship):
        array_push($friends, \App\User::find($friendship->user_requested));
        endforeach;

         $friends2 = array();

         $f2 = Friendship::where('status', 1)
                     ->where('user_requested', $this->id)
                     ->get();
        
        foreach($f2 as $friendship):
         
         array_push($friends2, \App\User::find($friendship->requester));
         endforeach;


         return array_merge($friends, $friends2);



    }
}