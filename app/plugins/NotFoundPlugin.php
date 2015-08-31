<?php

namespace Plugins;

use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Dispatcher;
use Phalcon\Mvc\Application\Exception as ApplicationException;
use Phalcon\Mvc\Dispatcher\Exception as DispatcherException;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;

/*
 *  use Phalcon\Mvc\Dispatcher\Exception as DispatchException;
 **/


/**
 * NotFoundPlugin
 *
 * Handles not-found controller/actions
 */
class NotFoundPlugin extends Plugin
{


  // Attach a listener
/*
  $eventsManager->attach("dispatch:beforeException", function ($event, $dispatcher, $exception) use ($di)
  {

    if ($event->getType() == 'beforeNotFoundAction')
    {
      $di->get('response')->redirect('site/error/notFound');
      return false;
    }

    // Controller or action doesn't exist
    if ($event->getType() == 'beforeException')
    {
      switch ($exception->getCode())
      {
        case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
        case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
          $di->get('response')->redirect('/show404');
          return false;
        default:
          $di->get('response')->redirect('/show500');
          return false;
      }
    }
  });
*/


  /**
   * This action is executed before execute any action in the application
   *
   * @param Event      $event
   * @param Dispatcher $dispatcher
   */
  public function beforeException(Event $event, Dispatcher $dispatcher, $exception) {
    if (!$exception instanceof DispatcherException) {
      if($exception instanceof ApplicationException) {
        $dispatcher->forward(array(
          'module'     => 'core',
          'controller' => 'error',
          'action'     => 'error500'
        ));
        return false;
      }
    }
    else{
      /*
       *  So you have to check first if the controller $dispatcher->getControllerName() != 'index' and $dispatcher->getActionName() != 'show404'.
       **/
      switch ($exception->getCode()) {
        case 2: //DispatcherException::EXCEPTION_HANDLER_NOT_FOUND:
        case 5: //DispatcherException::EXCEPTION_ACTION_NOT_FOUND:
          $dispatcher->forward(array(
            'module'     => 'core',
            'controller' => 'error',
            'action'     => 'error404'
          ));
          return false;
        default:
          $dispatcher->forward(array(
            'module'     => 'core',
            'controller' => 'error',
            'action'     => 'error500'
          ));
          return false;
      }
    }
    return false;
  }
}
