function test(){
    console.log('test');
    
}

function dateFormat(varDate = ''){
    return new Date(varDate).toISOString().slice(0,10);
}