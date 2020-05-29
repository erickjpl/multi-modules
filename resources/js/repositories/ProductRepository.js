import Service from '@/repositories/config/RepositoryFactory'

const API_URL = '/products/products'

export const ProductRepository = new Service(API_URL);
