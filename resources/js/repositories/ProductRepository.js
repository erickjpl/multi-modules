import Service from '@/repositories/config/RepositoryFactory'

const API_URL = '/api/products/products'

export const ProductRepository = new Service(API_URL);
