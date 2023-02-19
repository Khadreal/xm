<?php

namespace App\XM\Exception;

use Symfony\Component\HttpFoundation\Response;

class InvalidException extends BaseException
{
    public function __construct(array $details = [], $message = 'Invalid request')
    {
        $details = $this->detailField($details);

        parent::__construct(
            $message,
            Response::HTTP_BAD_REQUEST,
            $details
        );
    }

    private function detailField(array $details)
    {
        foreach ($details as $key => $detail) {
            if (isset($detail['field']) && isset($detail['message'])) {
                $field = lcfirst(
                    str_replace(
                        ' ',
                        '',
                        ucwords(str_replace('_', ' ', $detail['field']))
                    )
                );
                $detail['message'] = $field . ': ' . $detail['message'];
            }
            $details[$key] = $detail;
        }

        return $details;
    }
}
