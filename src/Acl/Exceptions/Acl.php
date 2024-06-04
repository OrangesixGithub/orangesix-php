<?php

namespace Orangesix\Acl\Exceptions;

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
            abort(400, $this->message);
        }
    }
}
