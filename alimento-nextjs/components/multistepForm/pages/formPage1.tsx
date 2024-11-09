import React from 'react';
import { useGlobalDish } from '@/context/dishFormContext';
import FormControl from '../components/formControl';

const FormPage1 = () => {
  const {
    dishName,
    setDishName,
    dishPrice,
    setDishPrice,
    dishDescription,
    setDishDescription,

    validDishName,
    setValidDishName,
    validDishPrice,
    setValidDishPrice,
    validDishDescription,
    setValidDishDescription,
  } = useGlobalDish();

  const setDishNameLogic = (e: React.ChangeEvent<HTMLInputElement>) => {
    setDishName(e.target.value);
    setValidDishName(e.target.value.length >= 1);
  };

  const setDishDescriptionLogic = (
    e: React.ChangeEvent<HTMLInputElement>
  ) => {
    setDishDescription(e.target.value);
    setValidDishDescription(e.target.value.length >= 1);
  };

  const setDishPriceLogic = (e: React.ChangeEvent<HTMLInputElement>) => {
    setDishPrice(Number(e.target.value));
    setValidDishPrice(e.target.value.length >= 1);
  };

  return (
    <div className="flex flex-col gap-8">
      <h1 className="text-primary-marineBlue font-bold text-[1.6rem] md:text-4xl leading-9">
        Dish Info
      </h1>
      <h3 className="text-gray-400 mt-2">
        Please provide your Dish name, description and price
      </h3>

      <div className="flex flex-col gap-5">
        <FormControl
          label={'Dish Title'}
          type={'text'}
          id={'dishName'}
          placeholder={'pizza'}
          onchange={setDishNameLogic}
          value={dishName}
          valid={validDishName}
        />
        <FormControl
          label={'Dish Description'}
          type={'text'}
          id={'dishDescription'}
          placeholder={'large - 8 slices, margherita'}
          onchange={setDishDescriptionLogic}
          value={dishDescription}
          valid={validDishDescription}
        />
        <FormControl
          label={'Dish Price'}
          type={'number'}
          id={'dishPrice'}
          placeholder={'e.g. example@upi'}
          onchange={setDishPriceLogic}
          value={dishPrice.toString()}
          valid={validDishPrice}
        />
      </div>
    </div>
  );
};

export default FormPage1;
