<?

namespace App\Utils; 


abstract class ConstantsUtil
{
    /* REQUESTS */
    public const TYPE_REQUEST = ['GET'];
    public const TYPE_GET = ['DDD'];
  

    /* ERROS */
    public const MSG_ERRO_TYPE_ROUTE = 'Rota não permitida!';
    public const MSG_ERRO_RESOURCE = 'Recurso inexistente!';
    public const MSG_ERRO_GENERIC = 'Algum erro ocorreu na requisição!';
    public const MSG_ERRO_NO_RETURN = 'Nenhum registro encontrado!';
    public const MSG_ERR0_JSON_EMPTY = 'O Corpo da requisição não pode ser vazio!';


    /* RETORNO JSON */
    const SUCCESS = 'success';
    const ERRO = 'erro';

    /* OUTRAS */

    public const TYPE = 'TYPE';
    public const RESPONSE = 'response';
}