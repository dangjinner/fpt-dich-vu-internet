<?php

namespace Botble\Ecommerce\Http\Controllers;

use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Facades\Assets;
use Botble\Ecommerce\Models\Review;
use Botble\Ecommerce\Tables\ReviewTable;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class ReviewController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this
            ->breadcrumb()
            ->add(trans('plugins/ecommerce::review.name'), route('reviews.index'));
    }

    public function index(ReviewTable $dataTable)
    {
        $this->pageTitle(trans('plugins/ecommerce::review.name'));

        Assets::addStylesDirectly('vendor/core/plugins/ecommerce/css/review.css');

        return $dataTable->renderTable();
    }

    public function show(int|string $id): View
    {
        Assets::addScriptsDirectly('vendor/core/plugins/ecommerce/js/admin-review.js')
            ->addStylesDirectly('vendor/core/plugins/ecommerce/css/review.css');

        $review = Review::query()
            ->with(['user', 'product' => function (BelongsTo $query) {
                $query
                    ->withCount('reviews')
                    ->withAvg('reviews', 'star');
            }])
            ->findOrFail($id);

        $this->pageTitle(trans('plugins/ecommerce::review.view', ['name' => $review->user->name]));

        return view('plugins/ecommerce::reviews.show', compact('review'));
    }

    public function destroy(int|string $id, Request $request)
    {
        try {
            $review = Review::query()->findOrFail($id);
            $review->delete();

            event(new DeletedContentEvent(REVIEW_MODULE_SCREEN_NAME, $request, $review));

            return $this
                ->httpResponse()
                ->setMessage(trans('core/base::notices.delete_success_message'))
                ->setData([
                    'next_url' => route('reviews.index'),
                ]);
        } catch (Exception $exception) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }
}
