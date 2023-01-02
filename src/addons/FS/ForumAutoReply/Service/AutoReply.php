<?php

namespace FS\ForumAutoReply\Service;


class AutoReply extends \XF\Service\AbstractService {

    
    public function checkWordInMessage($thread,$nodeId){
        
        
        $wordsForum=$this->getWords($nodeId);
        
        $threadMessage=$thread->FirstPost->message;
        

        if(count($wordsForum)){
            
            foreach($wordsForum as $record){
                
                    
                
                $wordMatch=$this->contentHasBannedWords($threadMessage,$record->word);
                
              
                        if($wordMatch){

                            $this->createPost($thread, $record->message, $record->User);

                            $this->changePrefix($thread, $record->prefix_id);
                            $this->changeGroup($thread,$record->user_group_id);
                            break; 
                        }
                  
                        
                        
            }
            
           
            
             
            
        }
        
        
    }
    
    public function getWords($nodeId){
        
        
      return $this->finder('FS\ForumAutoReply:ForumAutoReply')->where('node_id',$nodeId)->fetch();
        
    }
    
    public function createPost($thread, $message, $user) {


        
            $replier = \XF::service('XF:Thread\Replier', $thread, $user);
            $replier->setIsAutomated();
            if(!$message)
            {
               $message="--"; 
            }
            $replier->setMessage($message);

            $replier->save();
            
             
            $post = $replier->getPost();

         
           
            return $post;
        } 
    
    public function changeGroup($thread,$userGroupId){
        
        $user=$thread->User;
        $user->fastUpdate('user_group_id',$userGroupId);
        
        
    }
    
    public function changePrefix($thread,$prefixId){
        
        $editor = $this->service('XF:Thread\Editor', $thread);
        $editor->setPrefix($prefixId);
        $editor->save();
        
    }


    public function contentHasBannedWords($message, $bannedWords = '') {

       
        $message = 'ztstart ' . $message . ' ztend';

        if (!$message || !$bannedWords) {
            return false;
        }

        $bWords = array_map('trim', explode(",", $bannedWords));

        foreach ($bWords as $bWord) {
            if ($bWord) {
                if ((substr($bWord, 0, 1) == '*') && (substr($bWord, -1) == '*')) { //if it starts and ends with a *
                    $bWord = str_replace('*', '', $bWord);

                    preg_match("/(.*)" . preg_quote($bWord) . "(.*)/i", $message, $matches);
                    if ($matches) {
                        return $bWord;
                    }
                }

                if (substr($bWord, 0, 1) == '*') { //if it starts with a *
                    $bWord = str_replace('*', '', $bWord);

                    preg_match("/(.*)" . preg_quote($bWord) . "(?!\pL)/i", $message, $matches);
                    if ($matches) {
                        return $bWord;
                    }
                }

                if (substr($bWord, -1) == '*') { //if it ends with a *
                    $bWord = str_replace('*', '', $bWord);
                    preg_match("/(?<!\pL)" . preg_quote($bWord) . "(.*)/i", $message, $matches);
                    if ($matches) {
                        return $bWord;
                    }
                }

                if (substr($bWord, 0, 1) != '*') {
                    preg_match("/(?<!\pL)" . preg_quote($bWord) . "(?!\pL)/i", $message, $matches);
                    if ($matches) {
                        return $bWord;
                    }
                }
            }
        }

        return false;
    }

   


}
