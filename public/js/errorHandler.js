function errorHandler(error, context) {
    if (error.response) {
        const status = error.response.status;
        const errorData = error.response?.data?.errors || {};

        if (context.errors) {
            Object.keys(context.errors).forEach(
                (key) => (context.errors[key] = ""),
            );
        }

        switch (status) {
            case 404:
                context.errorObject.errorMessage = "Product not found";
                context.errorObject.errorStatus = status;
                context.errorObject.isError = true;
                break;
            case 422:
                for (let data in errorData) {
                    context.errors[data] = errorData[data][0];
                }
                break;
            case 500:
                context.errorObject.errorMessage =
                    "Internal server error: " + error.response.data.message;
                context.errorObject.errorStatus = status;
                context.errorObject.isError = true;
                break;
            case 401:
                context.errorObject.errorMessage = "You're not authorized";
                context.errorObject.errorStatus = status;
                context.errorObject.isError = true;
                break;
            default:
                context.errorObject.errorMessage =
                    error.response.data.message || "Something went wrong";
                context.errorObject.errorStatus = status;
                context.errorObject.isError = true;
        }
    } else {
        context.errorObject.isError = true;
        context.errorObject.errorMessage = "Couldn't connect to the server";
    }
}
