<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 13.07.2019
 * Time: 11:27
 */

namespace src\readModels\Shop;


use src\entities\Shop\Category;
use src\readModels\Shop\views\CategoryView;
use yii\helpers\ArrayHelper;

class CategoryReadRepository
{
    //private $client;

    public function __construct()
    {

    }

    public function getRoot(): Category
    {
        return Category::find()->roots()->one();
    }

    /**
     * @return Category[]
     */
    public function getAll(): array
    {
        return Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->all();
    }

    public function find($id): ?Category
    {
        return Category::find()->andWhere(['id' => $id])->andWhere(['>', 'depth', 0])->one();
    }

    public function findBySlug($slug): ?Category
    {
        return Category::find()->andWhere(['slug' => $slug])->andWhere(['>', 'depth', 0])->one();
    }

    public function getTreeWithSubsOf(Category $category = null): array
    {
        $query = Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft');

        if ($category) {
            $criteria = ['or', ['depth' => 1]];
            foreach (ArrayHelper::merge([$category], $category->parents) as $item) {
                $criteria[] = ['and', ['>', 'lft', $item->lft], ['<', 'rgt', $item->rgt], ['depth' => $item->depth + 1]];
            }
            $query->andWhere($criteria);
        } else {
            $query->andWhere(['depth' => 1]);
        }

        //todo
        $counts = 0;

        return array_map(function (Category $category) use ($counts) {
            return new CategoryView($category, $counts); //todo
        }, $query->all());
    }
}