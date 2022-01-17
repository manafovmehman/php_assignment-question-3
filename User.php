<?php

class User
{
    public function getUserName(ORM $orm, Request $request): ?string
    {
        $email = $this->getMasterEmail($request);

        if ($email === 'unknown') {
            return null;
        }

        $user = $orm->select('users', ['email' => $email]);

        if ($user === null) {
            return null;
        }

        return $user['username'];
    }

    protected function getMasterEmail(Request $request): string
    {
        if ($request->post('email') !== null) {
            return $request->post('email');
        }

        if ($request->post('masterEmail') !== null) {
            return $request->post('masterEmail');
        }

        return 'unknown';
    }
}