import { Empresa } from "../../../interfaces/Empresa";

export abstract class GenerarEmpresas {
    abstract getEmpresas(): Promise<Empresa[]>;
}
