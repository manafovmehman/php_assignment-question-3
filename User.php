<?php

class User
{
    private const UNKNOWN = 'unknown';

    public function getUserName(ORM $orm, Request $request): ?string
    {
        $email = $this->getMasterEmail($request);

        if ($email === static::UNKNOWN) {
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

        return static::UNKNOWN;
    }
}