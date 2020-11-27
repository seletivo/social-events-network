<?php

namespace Controller;

use Controller\AbstractController;

use Entity\InviteEventEntity;

use Model\InviteEventModel;

use Slim\Http\Request;
use Slim\Http\Response;

class InviteEventController extends AbstractController {
    public function __construct($container) {
        parent::__construct($container);
    }          

    /**
     * @api {get} /invite/event invites someone to be your friend
     * @apiVersion 1.0.0
    * @apiName invite
     * @apiGroup invite
     *                          
     * @apiHeaderExample {json} Header-Example:
     *    {
     *       "X-Token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzZXNzaW9uIjoiJDJ5JDEwJDRVcWQyWWtlYlQ0b0R0VDVmc3JKc2V1SGdKOEhrOTZVZzN5VHZrbUc0MlhGOWRyeVBuOVF1IiwiaWQiOjEsImlhdCI6MTYwNjE4MTcxOCwiZXhwIjoxNjA2MTg1MzE4fQ.MgVgpZF_pCUBlXVyvT8SOU708y2-1nqEdxGJkXImucQ"
     *       "E-Mail": "fulano@gmail.com"
     *    }
     *       
     * @apiError (401) String Unauthorized action
     * @apiError (402) String ID do evento não informado
     * @apiError (403) String Nenhum amigo informado para enviar o convite     
     * @apiError (405) InvalidTypeException Conteúdo do campo Status do Evento é inválido
     * @apiError (406) MessageError Validation error message     
     * 
     * @apiSuccess (200) {string} message Solicitação de convite de evento enviado     
     *      
     */
    public function invite(Request $request, Response $response) {
        $this->auth($request);

        $idEvent = $request->getParsedBodyParam('idEvent');

        if(empty($idEvent))
            return $response->withJson('ID do evento não informado', 402, JSON_UNESCAPED_UNICODE);           

        $userList = $request->getParsedBodyParam('userList');

        if(empty($userList))
            return $response->withJson('Nenhum amigo informado para enviar o convite', 403, JSON_UNESCAPED_UNICODE);                             

        try {            
            foreach ($userList as $value) {
                if(!(bool) $value['checked'])
                    continue;
                    
                $inviteModel = new InviteEventModel($this->container->em);
    
                $idUserfriendship = $value['id'];                                         

                $inviteEntity = $inviteModel->alreadySentInvite(
                    $idEvent,
                    $this->auth->getId(),
                    $idUserfriendship
                );   
    
                if(!empty($inviteEntity))
                    continue;
    
                $inviteEntity = new InviteEventEntity();

                $inviteEntity->setIdUser($this->auth->getId());
                $inviteEntity->setIdUserFriendship($idUserfriendship);
                $inviteEntity->setIdEvent($idEvent);                
                $inviteEntity->setStatus('assadas');   
                
                $inviteModel->save($inviteEntity);
            }  

            return $response->withJson('Solicitação de convite de evento enviado', 200, JSON_UNESCAPED_UNICODE);        
        } catch(InvalidTypeException $ex1) {
            return $response->withJson($ex1->getMessage(), 405, JSON_UNESCAPED_UNICODE);        
        } catch(\Exception $ex2) {
            return $response->withJson(
                $this->handlingError(
                    [$inviteEntity],
                    $ex2
                ), 406, JSON_UNESCAPED_UNICODE);        
        }
    }
}