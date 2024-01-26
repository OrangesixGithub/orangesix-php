<?php

namespace Orangecode\Acl\Exceptions;

use Orangecode\Service\Response\Enum\Message;
use Orangecode\Service\Response\ServiceResponse;

class Acl extends \Exception
{
    /**
     * @return \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|string|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|string|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        if (request()->method() == 'GET') {
            session()->flash('message', $this->message);
            session()->flash('messageType', 'warning');
            return redirect(url()->previous());
        } else {
            $response = new ServiceResponse();
            return $response->responseData([
                'redirect' => url()->previous()
            ])->responseSessionMessage($this->message, Message::Warning)
                ->response();
        }
    }
}
