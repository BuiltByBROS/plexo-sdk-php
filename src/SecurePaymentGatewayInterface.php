<?php
namespace Plexo\Sdk;

interface SecurePaymentGatewayInterface
{
//    [WebInvoke(UriTemplate = "Auth", RequestFormat = WebMessageFormat.Json, ResponseFormat = WebMessageFormat.Json, Method = "POST")]
//    Task<SignedServerResponse<string>> Authorize(ClientSignedRequest<Authorization> authorization);
    public function Authorize($auth);

//    [WebInvoke(UriTemplate = "Issuer", RequestFormat = WebMessageFormat.Json, ResponseFormat = WebMessageFormat.Json, Method = "POST")]
//    Task<SignedServerResponse<List<IssuerInfo>>> GetSupportedIssuers(ClientSignedRequest creq);
    public function GetSupportedIssuers();

//    [WebInvoke(UriTemplate = "Operation/Purchase", RequestFormat = WebMessageFormat.Json, ResponseFormat = WebMessageFormat.Json, Method = "POST")]
//    Task<SignedServerResponse<Transaction>> Purchase(ClientSignedRequest<PaymentRequest> payment);
    public function Purchase($payment);

//    [WebInvoke(UriTemplate = "Operation/Cancel", RequestFormat = WebMessageFormat.Json, ResponseFormat = WebMessageFormat.Json, Method = "POST")]
//    Task<SignedServerResponse<Transaction>> Cancel(ClientSignedRequest<CancelRequest> payment);
    public function Cancel($payment);

//    [WebGet(UriTemplate = "Key/{fingerprint}", RequestFormat = WebMessageFormat.Json, ResponseFormat = WebMessageFormat.Json)]
//    Task<SignedServerResponse<PublicKeyInfo>> GetServerPublicKey(string fingerprint);
    public function GetServerPublicKey($fingerprint);
}
