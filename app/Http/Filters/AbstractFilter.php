<?php 


namespace App\Http\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


abstract class AbstractFilter implements FilterInterface
{
/** @var array */
    private $queryParams = [];

    /**
     * AbstractFilter constructor.
     *
     * @param array $queryParams
     */
    public function __construct(array $queryParams) // - для получения параметров фильтрации из запроса
    {
        $this->queryParams = $queryParams; // - сохраняем эти параметры в свойстве класса для дальнейшего использования
    }

    abstract protected function getCallbacks(): array; // - абстрактный метод, который должен быть реализован в дочерних классах. Он должен возвращать массив, где ключами являются имена параметров фильтрации, а значениями - соответствующие функции обратного вызова (callback), которые будут применяться к запросу при наличии этих параметров.

    public function apply(Builder $builder) // - метод, который принимает объект Builder (строитель запросов Eloquent) и применяет к нему фильтры на основе переданных параметров. Внутри этого метода происходит следующее: 
    {
        $this->before($builder);  // - вызывается метод before, который может быть переопределен в дочерних классах для выполнения каких-либо действий перед применением фильтров. Например, можно использовать его для установки начальных условий или для логирования.

        foreach ($this->getCallbacks() as $name => $callback) { // - перебираются все коллбеки, возвращаемые методом getCallbacks. Для каждого коллбека проверяется, есть ли в переданных параметрах фильтрации параметр с именем, соответствующим ключу массива коллбеков. Если такой параметр существует, то вызывается соответствующий коллбек, которому передается текущий объект Builder и значение параметра фильтрации. Это позволяет динамически применять различные фильтры к запросу в зависимости от наличия определенных параметров в запросе.
            if (isset($this->queryParams[$name])) { // - проверка наличия параметра фильтрации в переданных параметрах - если параметр с именем $name существует в массиве $queryParams, то выполняется следующий код внутри блока if. Если параметр не существует, то коллбек для этого параметра не будет вызван, и фильтр не будет применен.
                call_user_func($callback, $builder, $this->queryParams[$name]); // - вызов функции обратного вызова (callback) для данного параметра фильтрации. Функция обратного вызова вызывается с помощью функции call_user_func, которая позволяет вызвать функцию, передав ей аргументы. В данном случае, коллбек вызывается с тремя аргументами: $builder - объект Builder, который представляет собой строителя запросов Eloquent; $this->queryParams[$name] - значение параметра фильтрации, который соответствует текущему коллбеку. Это позволяет применить соответствующий фильтр к запросу на основе значения параметра фильтрации. И такой процесс повторяется для каждого параметра фильтрации, который имеет соответствующий коллбек в массиве, возвращаемом методом getCallbacks.
            }
        }
    }

    /**
     * @param Builder $builder
     */
    protected function before(Builder $builder)
    {
    }

    /**
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    protected function getQueryParam(string $key, $default = null)
    {
        return $this->queryParams[$key] ?? $default;
    }

    /**
     * @param string[] $keys
     *
     * @return AbstractFilter
     */
    protected function removeQueryParam(string ...$keys)
    {
        foreach ($keys as $key) {
            unset($this->queryParams[$key]);
        }

        return $this;
    }
}