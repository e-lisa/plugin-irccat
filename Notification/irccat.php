<?php

namespace Kanboard\Plugin\irccat\Notification;

use Kanboard\Core\Base;
use Kanboard\Core\Notification\NotificationInterface;

/**
 * irccat Notification
 *
 * @package  notification
 * @author   Lisa Marie
 */
class irccat extends Base implements NotificationInterface
{
    /**
     * Send notification to a user
     *
     * @access public
     * @param  array     $user
     * @param  string    $eventName
     * @param  array     $eventData
     */
    public function notifyUser(array $user, $eventName, array $eventData)
    {
    }

    /**
     * Send notification to a project
     *
     * @access public
     * @param  array     $project
     * @param  string    $event_name
     * @param  array     $event_data
     */
    public function notifyProject(array $project, $event_name, array $event_data)
    {
        $webhook = $this->projectMetadataModel->get($project['id'], 'irccat_webhook_url', $this->configModel->get('irccat_webhook_url'));
        $auth['Authorization'] = 'Bearer '.$this->projectMetadataModel->get($project['id'], 'irccat_webhook_auth');
        $channel = $this->projectMetadataModel->get($project['id'], 'irccat_webhook_channel');

        if (! empty($webhook)) {
            $this->sendMessage($webhook, $auth, $channel, $project, $event_name, $event_data);
        }
    }

    /**
     * Get message to send
     *
     * @access public
     * @param  array     $project
     * @param  string    $event_name
     * @param  array     $event_data
     * @return array
     */
    public function getMessage(array $project, $event_name, array $event_data)
    {
        if ($this->userSession->isLogged()) {
            $author = $this->helper->user->getFullname();
            $title = $this->notificationModel->getTitleWithAuthor($author, $event_name, $event_data);
        } else {
            $title = $this->notificationModel->getTitleWithoutAuthor($event_name, $event_data);
        }
        $message = '';
        $message = '**['.$project['name']."]** ";
        if ($this->configModel->get('application_url') !== '') {
            $message .= '['.t($event_data['task']['title']." ").']';
            $message .= '( ';
            $message .= $this->helper->url->to('TaskViewController', 'show', array('task_id' => $event_data['task']['id'], 'project_id' => $project['id']), '', true);
            $message .= ' ) ';
        }

        $message .= $title;
        return $message;
    }

    /**
     * Send message to irccat
     *
     * @access private
     * @param  string    $webhook
     * @param  string    $auth
     * @param  array     $project
     * @param  string    $event_name
     * @param  array     $event_data
     */
    private function sendMessage($webhook, $auth, $channel, array $project, $event_name, array $event_data)
    {
        $payload = $this->getMessage($project, $event_name, $event_data);
        $payload = $channel.' '.$payload;
        $this->httpClient->doRequest('POST', $webhook, $payload, $auth);
    }
}
