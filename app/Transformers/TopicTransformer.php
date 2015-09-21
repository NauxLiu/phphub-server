<?php

namespace App\Transformers;

use App\Transformers\Traits\HelpersTrait;
use App\Transformers\Traits\IncludeUserTrait;
use League\Fractal\TransformerAbstract;
use App\Models\Topic;

/**
 * Class TopicTransformer.
 */
class TopicTransformer extends TransformerAbstract
{
    use IncludeUserTrait, HelpersTrait;

    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = array('author', 'last_reply_user');

    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = array();

    /**
     * Transform the \Topic entity.
     *
     * @param Topic $model
     *
     * @return array
     */
    public function transformData(Topic $model)
    {
        return [
            'id' => (int) $model->id,
            'title' => $model->title,
            'body' => $model->body,
            'user_id' => (int) $model->user_id,
            'node_id' => (int) $model->node_id,
            'is_excellent' => (boolean) $model->is_excellent,
            'is_wiki' => (boolean) $model->is_wiki,
            'view_count' => (int) $model->view_count,
            'reply_count' => (int) $model->reply_count,
            'favorite_count' => (int) $model->favorite_count,
            'vote_count' => (int) $model->vote_count,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }

    public function includeAuthor(Topic $model)
    {
        return $this->includeUser($model);
    }

    public function includeLastReplyUser(Topic $model)
    {
        return $this->includeUser($model, 'lastReplyUser');
    }
}
