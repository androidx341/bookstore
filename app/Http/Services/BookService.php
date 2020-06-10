<?php


namespace App\Http\Services;


use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Exception\NotReadableException;
use Intervention\Image\Facades\Image;

class BookService
{
    public static function createBook(Request $request)
    {
        $image = Image::make($request->coverImage);

        DB::beginTransaction();
        try {
            $image->save(ImageService::generateCoversPath());

            $book = Book::create([
                'title' => $request->title,
                'annotation' => $request->annotation,
                'pagesCount' => $request->pagesCount,
                'authorId' => $request->authorId,
                'coverImage' => sprintf('%s.%s', $image->filename, $image->extension),
                'createBy' => auth()->user()->id
            ]);

            DB::commit();

            return $book;
        } catch (\Exception $e) {
            DB::rollBack();
            $image->destroy();
        }

        return false;
    }

    public static function updateBook(Request $request, Book $book)
    {
        $requestData = array_intersect_key(
            request()->all(),
            array_flip(['title', 'annotation', 'pagesCount', 'authorId', 'published_at'])
        );

        DB::beginTransaction();
        try {
            if ($request->has('coverImage')) {
                $image = Image::make($request->coverImage);
                $image->save(ImageService::generateCoversPath());
                $requestData['coverImage'] = sprintf('%s.%s', $image->filename, $image->extension);
            }

            $book->update($requestData);
            DB::commit();

            return $book;
        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($image)) {
                $image->destroy();
            }
        }

        return false;
    }

    public static function removeBook(Book $book)
    {
        try {
            $image = Image::make(ImageService::generateCoversPath($book->coverImage));
            $image->destroy();
        } catch (NotReadableException $e) {
            //
        }

        return $book->delete();
    }
}
