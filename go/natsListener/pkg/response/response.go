package response

import "net/http"

var data chan Response

type Response struct {
	Value *http.Response
	Err   error
}

func init() {
	data = make(chan Response)
}

func GetChanData() chan Response {
	return data
}
