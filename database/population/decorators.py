from functools import wraps
import time
def timer(f):
    @wraps(f)
    def wrapper(*args, **kwargs):
        start = time.time()
        ret = f(*args, **kwargs)
        end = time.time()
        print(f"{f.__name__} ran in: {end - start} seconds")
        return ret
    return wrapper
