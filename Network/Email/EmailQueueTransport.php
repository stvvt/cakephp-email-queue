<?php

App::uses('AbstractTransport', 'Network/Email');

class EmailQueueTransport extends AbstractTransport
{
    public function send(CakeEmail $email)
    {
        /* @var $Queue EmailQueue */
        $Queue = ClassRegistry::init('EmailQueue.EmailQueue');

        $template = $email->template();

        $options = array(
            'subject' => $this->_decode($email->subject()), // @FIXME: We have to decode subject to prevent double encoding
            'template' => $template['template'],
            'layout' => $template['layout'],
            'format' => $email->emailFormat(),
            'config' => $email->config(),
        );

        list($options['from_email'], $options['from_name']) = @each($email->from());

        $Queue->enqueue(
            $email->to(),
            $email->viewVars() + array('language'=>Configure::read('Config.language')),
            $options
        );

        return true;
    }

    protected function _decode($text)
    {
        $appCharset = Configure::read('App.encoding');

        $internalEncoding = function_exists('mb_internal_encoding');
        if ($internalEncoding) {
            $restore = mb_internal_encoding();
            mb_internal_encoding($appCharset);
        }

        $return = mb_decode_mimeheader($text);

        if ($internalEncoding) {
            mb_internal_encoding($restore);
        }

        return $return;
    }

}