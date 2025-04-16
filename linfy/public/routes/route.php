<?php 
// Função de proteção e cotrole URL 

function urlValida(string $destino, array $urls_permitidas): bool {
    // Sanitiza 
    $destino = preg_replace('/[^a-zA-Z0-9_-]/', '', $destino);
    return array_key_exists($destino, $urls_permitidas);
}

function redirecionamentoPermitido(string $destino, array $urls_permitidas): void {
    $destino = preg_replace('/[^a-zA-Z0-9_-]/', '', $destino);
    if (array_key_exists($destino, $urls_permitidas)) {
        header("Location: " .$urls_permitidas[$destino]);
        exit();
    } else {
        http_response_code(403);
        die ("DEDESC_SYSTEM_SECURITY: ACESS DENIED `$destino`!");
    }
}



?>